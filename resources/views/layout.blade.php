<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/product.js') }}"></script>
    {{-- 商品情報の一覧表示 --}}
    <script>
        $(function() {
            $(document).ready(function(data) {
                $.ajax({
                    type: "get",
                    url: "/tutorial/resources/php/show.php",
                    datatype: "json",
                }).done(function(data) {
                    $.each(data, function(key, val) {
                        html = `
                            <tr class="item" data_product_keyword:"${val.product_name}" data_company_keyword:"${val.company_name}">
                            <td>${val.id}</td>
                            <td><img src="/storage/img_path/" . ${val.img_path}></td>
                            <td class="product_name">${val.product_name}</td>
                            <td>${val.price}</td>
                            <td>${val.stock}</td>
                            <td>${val.company_name}</td>
                            <td><button id="detail" onclick="clickDetail()">詳細表示</button></td>
                            <td><form method="POST" action="delete/{id}">@csrf<input type="submit" id="delete" value="削除"></form></td>
                            </tr>`
                        $("#showAllProduct").append(html);
                    });
                }).fail(function(jqXHR, textStatus, errorThrown, data) {
                    console.log("jqXHR      :" + jqXHR.status);
                    console.log("textStatus :" + textStatus);
                    console.log("errorThrown:" + errorThrown.message);
                });
                return false;
            });
        });
    </script>
    {{-- 商品削除 --}}
    <script>
        $(function() {
            $(document).on('click', '#delete', function() {
                var delete_confirm = confirm('商品を削除しますか？');

                if(delete_confirm == true) {
                    var id = $(this).closest('tr').children('td')[0].innerText;
                    var target = $(this).closest('tr');

                    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                    $.ajax({
                        type: "POST",
                        url: "delete/" + id,
                        data: {"id": id,
                        "_method": "DELETE",}
                    }).done(function() {
                        target.hide();
                        alert('商品を削除しました。');
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        console.log("jqXHR      :" + jqXHR.status);
                        console.log("textStatus :" + textStatus);
                        console.log("errorThrown:" + errorThrown.message);
                        alert('商品を削除できませんでした。')
                    });
                } else {
                    (function(e) {
                        e.preventDefault()
                    });
                };
                return false;
            });
            }
        );
    </script>
    {{-- 商品検索 --}}
    <script>
        $(function() {
            $('#search').on('click', function() {
                var product_keyword = document.getElementById('productKeyword').value
                var company_keyword = document.getElementById('companyKeyword').value
                var lowest_price = document.getElementById('lowestPrice').value
                var highest_price = document.getElementById('highestPrice').value
                var lowest_stock = document.getElementById('lowestStock').value
                var highest_stock = document.getElementById('highestStock').value
                $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
                $.ajax({
                    url: "/tutorial/resources/php/search.php",
                    type: "POST",
                    data: {
                        "product_keyword": product_keyword,
                        "company_keyword": company_keyword,
                        "lowest_price": lowest_price,
                        "highest_price": highest_price,
                        "lowest_stock": lowest_stock,
                        "highest_stock": highest_stock,
                    },
                    dataType: "json",
                }).done(function(data) {
                    $('.item').remove();
                    $.each(data, function(key, val) {
                        html = `
                            <tr class="item" data_product_keyword:"${val.product_name}" data_company_keyword:"${val.company_id}">
                            <td>${val.id}</td>
                            <td><img src="/storage/img_path/" . ${val.img_path}></td>
                            <td class="product_name">${val.product_name}</td>
                            <td>${val.price}</td>
                            <td>${val.stock}</td>
                            <td>${val.company_name}</td>
                            <td><button id="detail" onclick="clickDetail()">詳細表示</button></td>
                            <td><form method="POST" action="delete/{id}">@csrf<input type="submit" id="delete" value="削除"></form></td>
                            </tr>`
                        $("#showAllProduct").append(html);
                    });
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.log("jqXHR      :" + jqXHR.status);
                    console.log("textStatus :" + textStatus);
                    console.log("errorThrown:" + errorThrown.message);
                    console.log("URL            : " + url);
                });
                return false;
            });
        });
    </script>
    {{-- 商品の並び替え --}}
    <script>
        $(function() {
            $('th').on('click', function() {
                let ele = $(this).attr('id');
                let sortFlg = $(this).data('sort');
                $('th').data('sort', "");

                if(sortFlg == "" || sortFlg == "desc") {
                    sortFlg = "asc";
                    $(this).data('sort', "asc");
                } else {
                    sortFlg = "desc";
                    $(this).data('sort', "desc");
                }

                sortTable(ele, sortFlg);
            });
        });
        function sortTable(ele, sortFlg){
            let arr = $('table tbody tr').sort(function(a, b) {

                if($.isNumeric($(a).find('td').eq(ele).text())){
                    let aNum = Number($(a).find('td').eq(ele).text());
                    let bNum = Number($(b).find('td').eq(ele).text());

                    if(sortFlg == "asc") {
                        return aNum - bNum;
                    } else {
                        return bNum - aNum;
                    }
                } else {
                    let sortNum = 1;

                    if($(a).find('td').eq(ele).text().toLowerCase() > $(b).find('td').eq(ele).text().toLowerCase()) {
                        sortNum = 1;
                    } else {
                        sortNum = -1;
                    }

                    if(sortFlg == "desc") {
                        sortNum *= (-1);
                    }

                    return sortNum;
                }
            });

            $('table tbody').html(arr);
        }
    </script>
</head>
<body>
    <head><h2 class="body_title">商品管理システム</h2></head>
    @yield('content')
    <footer><p>Copyright © 2022 Kaito Wada</p></footer>
</body>
</html>
