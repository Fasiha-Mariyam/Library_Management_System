<?php include("db.php");

class data extends db {
    private $bookpic;
    private $bookname;
    private $bookdetail;
    private $bookauthor;
    private $bookpub;
    private $branch;
    private $bookprice;
    private $bookquantity;
    private $type;

    private $book;
    private $userselect;
    private $days;
    private $getdate;
    private $returnDate;

    function __construct() {
        // echo " constructor ";
        // echo "</br></br>";
    }

    function adminLogin($t1, $t2) {

        $q="SELECT * FROM admin where email='$t1' and pass='$t2'";
        $recordSet=$this->connection->query($q);
        $result=$recordSet->rowCount();
        if ($result > 0) {
        
                header("location: admin_service_dashboard.php");
            
        }
        else {
            header("location: index.php?msg=Invalid Credentials");
        }
    }

    function userLogin($t1, $t2) {
        $q="SELECT * FROM userdata where email='$t1' and pass='$t2'";
        $recordSet=$this->connection->query($q);
        $result=$recordSet->rowCount();
        if ($result > 0) {

            foreach($recordSet->fetchAll() as $row) {
                $logid=$row['id'];
                header("location: otheruser_dashboard.php?userlogid=$logid");
            }
        }

        else {
            header("location: index.php?msg=Invalid Credentials");
        }

    }


    function addnewuser($name,$pasword,$email){
        $this->name=$name;
        $this->pasword=$pasword;
        $this->email=$email;


        $q="INSERT INTO userdata(id, name, email, pass)VALUES('','$name','$email','$pasword')";

        if($this->connection->exec($q)) {
            header("Location:admin_service_dashboard.php?msg=New Add done");
        }

        else {
            header("Location:admin_service_dashboard.php?msg=Register Fail");
        }
    }
 
    function addbook($bookpic, $bookname, $bookdetail, $bookauthor, $bookpub, $branch, $bookprice, $bookquantity) {
        $this->$bookpic=$bookpic;
        $this->bookname=$bookname;
        $this->bookdetail=$bookdetail;
        $this->bookauthor=$bookauthor;
        $this->bookpub=$bookpub;
        $this->branch=$branch;
        $this->bookprice=$bookprice;
        $this->bookquantity=$bookquantity;

       $q="INSERT INTO book (id,bookpic,bookname, bookdetail, bookauthor, bookpub, branch, bookprice,bookquantity,bookrent)VALUES('','$bookpic', '$bookname', '$bookdetail', '$bookauthor', '$bookpub', '$branch', '$bookprice', '$bookquantity',0)";

        if($this->connection->exec($q)) {
            header("Location:admin_service_dashboard.php?msg=done");
        }

        else {
            header("Location:admin_service_dashboard.php?msg=fail");
        }

    }

    function getbook() {
        $q="SELECT * FROM book ";
        $data=$this->connection->query($q);
        return $data;
    }

    function userdata() {
        $q="SELECT * FROM userdata ";
        $data=$this->connection->query($q);
        return $data;
    }

    function delteuserdata($id){
        $q="DELETE from userdata where id='$id'";
        if($this->connection->exec($q)){
    
            
           header("Location:admin_service_dashboard.php?msg=done");
        }
        else{
           header("Location:admin_service_dashboard.php?msg=fail");
        }
    }

    function deletebook($id){
        $q="DELETE from book where id='$id'";
        if($this->connection->exec($q)){
    
            
           header("Location:admin_service_dashboard.php?msg=done");
        }
        else{
           header("Location:admin_service_dashboard.php?msg=fail");
        }
    }

    function getbookdetail($id){
        $q="SELECT * FROM book where id ='$id'";
        $data=$this->connection->query($q);
        return $data;
    }

    function getbookissue(){
        $q="SELECT * FROM book where bookquantity!=0 ";
        $data=$this->connection->query($q);
        return $data;
    }

    function issuebook($book,$userselect,$days,$getdate,$returnDate){
        $this->$book= $book;
        $this->$userselect=$userselect;
        $this->$days=$days;
        $this->$getdate=$getdate;
        $this->$returnDate=$returnDate;


        $q="SELECT * FROM book where bookname='$book'";
        $recordSetss=$this->connection->query($q);

        $q="SELECT * FROM userdata where name='$userselect'";
        $recordSet=$this->connection->query($q);
        $result=$recordSet->rowCount();

        if ($result > 0) {

            foreach($recordSet->fetchAll() as $row) {
                $issueid=$row['id'];
                // $issuetype=$row['type'];

                // header("location: admin_service_dashboard.php?logid=$logid");
            }
            foreach($recordSetss->fetchAll() as $row) {
                $bookid=$row['id'];
                $bookname=$row['bookname'];

                    $newbookquantity=$row['bookquantity']-1;
                     $newbookrent=$row['bookrent']+1;
            }

        
            $q="UPDATE book SET bookquantity='$newbookquantity', bookrent='$newbookrent' where id='$bookid'";
            if($this->connection->exec($q)){

            $q="INSERT INTO issuebook (userid,issuename,issuebook,issuedays,issuedate,issuereturn,fine)VALUES('$issueid','$userselect','$book','$days','$getdate','$returnDate','0')";

            if($this->connection->exec($q)) {
                header("Location:admin_service_dashboard.php?msg=done");
            }
    
            else {
                header("Location:admin_service_dashboard.php?msg=fail");
            }
            }
            else{
               header("Location:admin_service_dashboard.php?msg=fail");
            }


        }

        else {
            header("location: index.php?msg=Invalid Credentials");
        }


    }

    function issuereport(){
        $q="SELECT * FROM issuebook ";
        $data=$this->connection->query($q);
        return $data;
        
    }

    function requestbookdata(){
        $q="SELECT * FROM bookrequest ";
        $data=$this->connection->query($q);
        return $data;
    }

    function issuebookapprove($book,$userselect,$days,$getdate,$returnDate,$reqid){
        $this->$book= $book;
        $this->$userselect=$userselect;
        $this->$days=$days;
        $this->$getdate=$getdate;
        $this->$returnDate=$returnDate;


        $q="SELECT * FROM book where bookname='$book'";
        $recordSetss=$this->connection->query($q);

        $q="SELECT * FROM userdata where name='$userselect'";
        $recordSet=$this->connection->query($q);
        $result=$recordSet->rowCount();

        if ($result > 0) {

            foreach($recordSet->fetchAll() as $row) {
                $issueid=$row['id'];
                // $issuetype=$row['type'];

                // header("location: admin_service_dashboard.php?logid=$logid");
            }
            foreach($recordSetss->fetchAll() as $row) {
                $bookid=$row['id'];
                $bookname=$row['bookname'];

                $newbookquantity=$row['bookquantity']-1;
                $newbookrent=$row['bookrent']+1;
            }

        
            $q="UPDATE book SET bookquantity='$newbookquantity', bookrent='$newbookrent' where id='$bookid'";
            if($this->connection->exec($q)){

            $q="INSERT INTO issuebook (userid,issuename,issuebook,issuedays,issuedate,issuereturn,fine)VALUES('$issueid','$userselect','$book','$days','$getdate','$returnDate','0')";

            if($this->connection->exec($q)) {

                $q="DELETE from bookrequest where id='$reqid'";
                $this->connection->exec($q);
                header("Location:admin_service_dashboard.php?msg=done");
            }
    
            else {
                header("Location:admin_service_dashboard.php?msg=fail");
            }
            }
            else{
               header("Location:admin_service_dashboard.php?msg=fail");
            }

        }

        else {
            header("location: index.php?msg=Invalid Credentials");
        }


    }

    function userdetail($id){
        $q="SELECT * FROM userdata where id ='$id'";
        $data=$this->connection->query($q);
        return $data;
    }

    function getissuebook($userloginid) {

        $newfine="";
        $issuereturn="";

        $q="SELECT * FROM issuebook where userid='$userloginid'";
        $recordSetss=$this->connection->query($q);


        foreach($recordSetss->fetchAll() as $row) {
            $issuereturn=$row['issuereturn'];
            $fine=$row['fine'];
            $newfine= $fine;

            
                //  $newbookrent=$row['bookrent']+1;
        }


        $getdate= date("y/m/d");
        if($issuereturn<$getdate){
            $q="UPDATE issuebook SET fine='$newfine' where userid='$userloginid'";

            if($this->connection->exec($q)) {
                $q="SELECT * FROM issuebook where userid='$userloginid' ";
                $data=$this->connection->query($q);
                return $data;
            }
            else{
                $q="SELECT * FROM issuebook where userid='$userloginid' ";
                $data=$this->connection->query($q);
                return $data;  
            }

        }
        else{
            $q="SELECT * FROM issuebook where userid='$userloginid'";
            $data=$this->connection->query($q);
            return $data;

        }

    }

    function returnbook($id){
        $fine="";
        $bookquantity="";
        $issuebook="";
        $bookrentel="";

        $q="SELECT * FROM issuebook where id='$id'";
        $recordSet=$this->connection->query($q);

        foreach($recordSet->fetchAll() as $row) {
            $userid=$row['userid'];
            $issuebook=$row['issuebook'];
            $fine=$row['fine'];

        }
        if($fine==0){

        $q="SELECT * FROM book where bookname='$issuebook'";
        $recordSet=$this->connection->query($q);   

        foreach($recordSet->fetchAll() as $row) {
            $bookquantity=$row['bookquantity']+1;
            $bookrentel=$row['bookrent']-1;
        }
        $q="UPDATE book SET bookquantity='$bookquantity', bookrent='$bookrentel' where bookname='$issuebook'";
        $this->connection->exec($q);

        $q="DELETE from issuebook where id=$id and issuebook='$issuebook' and fine='0' ";
        if($this->connection->exec($q)){
    
            header("Location:otheruser_dashboard.php?userlogid=$userid");
         }
        //  else{
        //     header("Location:otheruser_dashboard.php?msg=fail");
        //  }
        }
        // if($fine!=0){
        //     header("Location:otheruser_dashboard.php?userlogid=$userid&msg=fine");
        // }
       

    }

    function requestbook($userid,$bookid){

        $q="SELECT * FROM book where id='$bookid'";
        $recordSetss=$this->connection->query($q);

        $q="SELECT * FROM userdata where id='$userid'";
        $recordSet=$this->connection->query($q);

        foreach($recordSet->fetchAll() as $row) {
            $username=$row['name'];
        }

        foreach($recordSetss->fetchAll() as $row) {
            $bookname=$row['bookname'];
        }

        $q="INSERT INTO bookrequest (id,userid,bookid,username,bookname,issuedays)VALUES('','$userid', '$bookid', '$username', '$bookname', '7')";

        if($this->connection->exec($q)) {
            header("Location:otheruser_dashboard.php?userlogid=$userid");
        }

        else {
            header("Location:otheruser_dashboard.php?msg=fail");
        }

    }
}