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
                echo $_POST["username"];
                echo("pass = " . $arrQueryStringParams['username']);
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

    /* "/user/list/123" - get user by ID Post */
    public function getUserByID($id)
    {
        echo("Get data for ID ".$id);

    }
}
?>