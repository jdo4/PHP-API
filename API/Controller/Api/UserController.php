<?php
class UserController extends BaseController
{
    /** 
     *  UserController class extends the BaseController class. 
     * Ideally, this class would contain the action methods that
     * are associated with the REST endpoints that are defined for 
     * the user entity. 
     * In our case, for example, the /user/list REST endpoint 
     * corresponds to the listAction method. 
     * In this way, you can also define other methods for other REST endpoints.

     * "/user/list" Endpoint - Get All users */
    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $userModel = new UserModel();
                $intLimit = 10;
                if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
                    $intLimit = $arrQueryStringParams['limit'];
                }
                $arrUsers = $userModel->getUsers($intLimit);
                $responseData = json_encode($arrUsers);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    public function products()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $userModel = new UserModel();
                $intLimit = 10;
                if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
                    $intLimit = $arrQueryStringParams['limit'];
                }
                $arrUsers = $userModel->getProducts($intLimit);
                $responseData = json_encode($arrUsers);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    public function signup()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'POST') {
            try {

                $userModel = new UserModel();
                $intLimit = 10;
                $username = '';
                $email = '';
                $pass = '';
            
                if (isset($_POST["username"]) && $_POST["username"] && isset($_POST['email']) && $_POST['email'] && isset($_POST['password']) && $_POST['password']) {
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $pass = $_POST['password'];
                }
                $arrUsers = $userModel->signupUsers($username,$email,$pass);
                echo $arrUsers;
                $responseData = $arrUsers;
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
                $this->sendOutput(json_encode(array('code' => "200",'status' => "user created successfuly",)),
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    public function comments()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'GET') {
            try {

                $userModel = new UserModel();
                if (isset($_POST["userid"]) && $_POST["userid"] && isset($_POST['productid']) && $_POST['productids']) {
                    $userid = $_POST['userid'];
                    $productid = $_POST['productid'];
                }
                $arrUsers = $userModel->getCommets($userid,$productid);
                $responseData = $arrUsers;
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else if(strtoupper($requestMethod) == 'POST'){
            try {

                $userModel = new UserModel();
                if (isset($_POST["productid"]) && $_POST["productid"] && isset($_POST['userid']) && $_POST['userid'] && isset($_POST['rating']) && $_POST['rating'] && isset($_POST['img']) && $_POST['img'] && isset($_POST['txt']) && $_POST['txt']) {
                    $pid = $_POST['productid'];
                    $uid = $_POST['userid'];
                    $rating = $_POST['rating'];
                    $img = $_POST['img'];
                    $txt = $_POST['txt'];
                }
                $arrUsers = $userModel->postComment($pid,$uid,$rating,$img,$txt);
                 
                
                $responseData = $arrUsers;
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        }else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(json_encode($responseData),
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    public function deletecomments()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
       if(strtoupper($requestMethod) == 'POST'){
            try {

                $userModel = new UserModel();
                if (isset($_POST["productid"]) && $_POST["productid"] && isset($_POST['userid']) && $_POST['userid']) {
                    $pid = $_POST['productid'];
                    $uid = $_POST['userid'];
                }
                $arrUsers = $userModel->deleteComment($pid,$uid);
                $responseData = $arrUsers;
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        }else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(json_encode($responseData),
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    public function login()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'POST') {
            try {

                $userModel = new UserModel();
                if (isset($_POST["username"]) && $_POST["username"] && isset($_POST['password']) && $_POST['password']) {
                    $username = $_POST['username'];
                    $pass = $_POST['password'];
                }
                $arrUsers = $userModel->loginUser($username,$pass);
                 
                
                $responseData = $arrUsers;
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
           if($arrUsers == "Fail"){
            echo $responseData;
            
           $this->sendOutput(json_encode(array('code' => "200",'status' => "Authentication fail",)),
                
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
           }else{
            $this->sendOutput(json_encode(array('code' => "200",'status' => "Login successful",)),
                
            array('Content-Type: application/json', 'HTTP/1.1 200 OK')
        );
           }
            
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }


    public function cartdetails()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $userModel = new UserModel();
                $intLimit = 10;
                 
                if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
                    $intLimit = $arrQueryStringParams['limit'];
                }
                $arrUsers = $userModel->getCartDetail($intLimit);
                $responseData = json_encode($arrUsers);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    //Insert CartDetails
    //http://localhost/Assignment2/index.php/api/cart/cartdetailsinsert

    public function cartdetailsinsert()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'POST') {
            try {
                $userModel = new UserModel();
                $intLimit = 10;

                $productid = '';
                $userid = '';
                $quantities = '';
                $user = '';

                if (isset($_POST['productid']) && isset($_POST['userid']) && isset($_POST['quantities'])) {
                    $productid = $_POST['productid'];
                    $userid = $_POST['userid'];
                    $quantities = $_POST['quantities'];
                    $user = $_POST['user'];
                }
                $arrUsers = $userModel->insertCartDetail($productid,$userid,$quantities,$user);
                $responseData = $arrUsers;
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                json_encode(array('message'=>'Inserted Successfully')),
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('Code'=>'200','status'=>'false','error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    //Update CartDetails
    //http://localhost/Assignment2/index.php/api/cart/cartdetailsupdate

    public function cartdetailsupdate()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'POST') {
            try {
                $userModel = new UserModel();
                $intLimit = 10;

                $userid = '';
                $quantities = '';
                $cartid = '';

                if (isset($_POST['cartid']) && isset($_POST['userid']) && isset($_POST['quantities'])) {                
                    $userid = $_POST['userid'];
                    $quantities = $_POST['quantities'];                
                    $cartid = $_POST['cartid'];
                }
                $arrUsers = $userModel->updateCartDetail($cartid, $userid, $quantities);
                $responseData = $arrUsers;
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                json_encode(array('Code'=>'200','message'=>'Updated Successfully','status'=>'false')),
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('Code'=>'200','status'=>'false','error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    //Delete CartDetails
    //http://localhost/Assignment2/index.php/api/cart/cartdetailsdelete

    public function cartdetailsdelete()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'POST') {
            try {
                $userModel = new UserModel();
                $intLimit = 10;

                $cartid = '';

                if (isset($_POST['cartid'])) {             
                    $cartid = $_POST['cartid'];
                }
                $arrUsers = $userModel->deleteCartDetail($cartid);
                $responseData = $arrUsers;
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                json_encode(array('Code'=>'200','message'=>'Deleted Successfully','status'=>'false')),
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('Code'=>'200','status'=>'false','error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
    
    /* "/user/list/123" - get user by ID Post */
    public function getUserByID($id)
    {
        echo("Get data for ID ".$id);

    }
}
?>