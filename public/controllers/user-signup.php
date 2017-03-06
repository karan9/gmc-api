<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/handlers/User.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/handlers/Response.php";

//TODO: User Input Sanitization
function main() {
    $name = $_POST['name'];
    $passwd = $_POST['password'];
    $category = $_POST['category'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    // create user
    $user = new User();
    // create a new user
    $user->create_new_user($name, $email, $mobile, $passwd, $category);
    $response = new Response();
    if ($user->save()) {
        $res = $response->createResponse(ResponseHelper::HTTP_200);
        if ($res) {
            $response->sendResponse();
        } else {
            echo json_encode(array("error" => "true", "message" => "Unable to send response"));
        }
    } else {
        $res = $response->createResponse(ResponseHelper::HTTP_405);
        if ($res) {
            $response->sendResponse();
        } else {
            echo json_encode(array("error" => "true", "message" => "Unable to send response"));
        }
    }
}
main();