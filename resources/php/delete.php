<php
if(isset($_POST[#delete])) {
            $sql = $pdo->prepare("SELECT * FROM products");
            $sql->execute();
            $result = $sql->fetch();
            print_r($result);
            $date=$_POST['foo'];
            print_r($data);
            $data = array();
            $delete_data = $pdo->query("DELETE FROM products WHERE id =");
            echo json_encode( $data );
} catch (PDOException $e) {
        die();
}
