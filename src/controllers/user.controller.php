<?php
class UserController
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @param UserRepository $userRepository
     */
    public function __construct($userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * @param int $page
     * @return Response
     */
    public function getAllAccounts($page)
    {
        $offset = ($page - 1) * 10;
        $data = $this->userRepository->findIgnoreId(Session::get("user_id"), 10, $offset);
        return new Response(true, $data, "Thanh cong");
    }
    public function updateRole()
    {
        $id = htmlspecialchars($_POST["id"]);
        $role = htmlspecialchars($_POST["role"]);
        $result = $this->userRepository->updateRole($id, $role);
        return new Response($result, null, $result ? "Cập nhật thành công!" : "Cập nhật thất bại");
    }
    public function countEachRole(){
        $data = $this->userRepository->countEach();
        return new Response(true, $data, "Thanh cong");
    }
}
