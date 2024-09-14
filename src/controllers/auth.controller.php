<?php
class AuthController
{
    private $userRepository;
    /**
     * @param UserRepository $userRepository
     */
    public function __construct($userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function me()
    {
        $user_id = Session::get("user_id");
        $user = $this->userRepository->findById($user_id);
        return new Response(true, $user->toArray(), "Thanh cong");
    }
    public function login()
    {
        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);

        $emailRegex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        $vnPhoneRegex = "/^(0|\+84)(3|5|7|8|9)[0-9]{8}$/";
        $user = null;
        if (preg_match($vnPhoneRegex, $username)) {
            $user = $this->userRepository->findByPhone($username);
        } else if (preg_match($emailRegex, $username)) {
            $user = $this->userRepository->findByEmail($username);
        } else {
            $user = $this->userRepository->findByUsername($username);
        }
        if (!$user) {
            return new Response(false, null, "Người dùng không tồn tại!");
        }
        if (!password_verify($password, $user->password)) {
            return new Response(false, null, "Mật khẩu không đúng!");
        }

        Session::set("is_authenticated", true);
        Session::set("user_id", $user->id);

        return new Response(true, $user->toArray(), "Đăng nhập thành công");
    }
    public function logout()
    {
        session_destroy();
        return new Response(true, null, "Đăng xuất thành công");
    }
    public function register()
    {
        $username = htmlspecialchars($_POST["username"]);
        $fullName = htmlspecialchars($_POST["fullName"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        $phone = htmlspecialchars($_POST["phone"]);

        $userByUsername = $this->userRepository->findByUsername($username);
        if ($userByUsername) {
            return new Response(false, null, "Tên đăng nhập đã tồn tại!");
        }
        $userByPhone = $this->userRepository->findByPhone($phone);
        if ($userByPhone) {
            return new Response(false, null, "Số điện thoại đã tồn tại!");
        }
        $userByEmail = $this->userRepository->findByEmail($email);
        if ($userByEmail) {
            return new Response(false, null, "Email đã tồn tại!");
        }

        $user = new UserEntity(0, $username, $email, $password, $fullName, $phone, UserRole::User->name);
        $status = $this->userRepository->save($user);

        return new Response($status, null, $status ? "Đăng kí thành công!" : "Đăng kí thất bại!");
    }
}
