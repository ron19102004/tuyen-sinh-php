
 /* Student, Cashier, Admin, Admission Committee, Board of Directors tương ứng với sinh viên, thu ngân, admin, ban tuyển sinh, và ban giám hiệu */
create table if not exists users(
    id int primary key auto_increment not null,
    username varchar(255) not null unique,
    email varchar(255) not null unique,
    password varchar(255) not null,
    fullName varchar(255) not null,
    phone varchar(255) not null unique,
    deleted tinyint(1) default 0,
    role ENUM('User', 'Cashier', 'Admin', 'AdmissionCommittee', 'BoardOfDirectors') default "User"
);

create table if not exists ho_so(
    ho_so_id int primary key,
    ho_ten varchar(255) not null,
    gioi_tinh enum('male','female') default "male",
    ngay_thang_nam_sinh varchar(255) not null,
    dan_toc varchar(255) not null,
    so_nha varchar(255) not null,
    ten_pho varchar(255) not null,
    ten_phuong varchar(255) not null,
    ten_thanh_pho varchar(255) not null,
    ten_tinh varchar(255) not null,
    sdt_1 varchar(255) not null,
    sdt_2 varchar(255) not null,
    ten_truong_lop_9 varchar(255) not null,
    ten_thanh_pho_cua_truong varchar(255) not null,
    ten_tinh_cua_truong varchar(255) not null,
    so_bao_danh bigint not null unique,
    mon_chuyen_du_thi varchar(255) not null,
    nguyen_vong_1 varchar(255) not null,
    nguyen_vong_2 varchar(255) not null,
    hanh_kiem_hoc_luc_6 varchar(255) not null,
    hanh_kiem_hoc_luc_7 varchar(255) not null,
    hanh_kiem_hoc_luc_8 varchar(255) not null,
    hanh_kiem_hoc_luc_1_9 varchar(255) not null,
    loai_tot_nghiep_thcs varchar(255) not null,
    diem_tb_mon_chuyen DECIMAL(5, 2) not null,
    diem_tb_lop_9 DECIMAL(5, 2) not null,
    diem_tb_toan_lop_9 DECIMAL(5, 2) not null,
    diem_tb_van_lop_9 DECIMAL(5, 2) not null,
    diem_tb_ngoai_ngu_lop_9 DECIMAL(5, 2) not null,
    ten_ngoai_ngu varchar(255) not null,
    foreign key (ho_so_id) references users(id) ON DELETE CASCADE
);

create table if not exists trang_thai_ho_so(
    trang_thai_ho_so_id int primary key,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    trang_thai_ho_so ENUM('ChoDuyet','DaDuyet','TuChoi','YeuCauChinh') default "ChoDuyet",
    thong_tin_nguoi_cap_nhat varchar(255) not null,
    ghi_chu text,
    foreign key (trang_thai_ho_so_id) references ho_so(ho_so_id) ON DELETE CASCADE
);
create table if not exists thanh_toan_ho_so(
    thanh_toan_ho_so_id int primary key,
    trang_thai_thanh_toan tinyint(1) default 0,
    so_tien DECIMAL(12, 3) not null,
    ngay_thanh_toan DATE,
    foreign key (thanh_toan_ho_so_id) references ho_so(ho_so_id) ON DELETE CASCADE
);
create table if not exists lich_thi(
    id int primary key auto_increment,
    ten_ky_thi text not null,
    ten_mon_thi varchar(255) not null,
    ngay_thi DATE not null,
    dia_diem_thi text not null,
    gio_thi time not null
);
create table if not exists ho_so_lich_thi(
    id int primary key auto_increment,
    ho_so_id int not null,
    lich_thi_id int not null,
    foreign key (ho_so_id) references ho_so(ho_so_id) ON DELETE CASCADE,
    foreign key (lich_thi_id) references lich_thi(id) ON DELETE CASCADE
);
create table if not exists ket_qua_thi_tuyen(
    ket_qua_thi_tuyen_id int primary key,
    diem_toan DECIMAL(5, 2) default 0.0,
    diem_van DECIMAL(5, 2) default 0.0,
    diem_ngoai_ngu DECIMAL(5, 2) default 0.0,
    diem_mon_chuyen DECIMAL(5, 2) default 0.0,
    foreign key (ket_qua_thi_tuyen_id) references ho_so(ho_so_id) ON DELETE CASCADE
);

INSERT INTO users (username, email, password, fullName, phone, role)
VALUES
('user1', 'user1@example.com', 'password1', 'Nguyen Van A', '0123456789', 'User'),
('user2', 'user2@example.com', 'password2', 'Tran Van B', '0987654321', 'User'),
('user6', 'user6@example.com', 'password3', 'Le Thi C', '0912345678', 'User'),
('user3', 'user3@example.com', 'password4', 'Pham Van D', '0909090909', 'User'),
('user7', 'user7@example.com', 'password5', 'Nguyen Thi E', '0911223344', 'User'),
('user4', 'user4@example.com', 'password6', 'Do Thi F', '0998877665', 'User'),
('user8', 'user8@example.com', 'password7', 'Hoang Van G', '0900789567', 'User'),
('user9', 'user9@example.com', 'password8', 'Tran Thi H', '0888666444', 'User'),
('user10', 'user10@example.com', 'password9', 'Pham Thi I', '0977111222', 'User'),
('user5', 'user5@example.com', 'password10', 'Nguyen Van J', '0933445566', 'User'),
('admin', 'admin@example.com', '$2y$10$4TeTlcAnTQNkJ2nkanJDc.WOzx2w093.pHXQOm4K0YgaTwwMZHCJm','ADMIN','0392477615','ADMIN');

INSERT INTO ho_so (ho_so_id, ho_ten, gioi_tinh, ngay_thang_nam_sinh, dan_toc, so_nha, ten_pho, ten_phuong, ten_thanh_pho, ten_tinh, sdt_1, sdt_2, ten_truong_lop_9, ten_thanh_pho_cua_truong, ten_tinh_cua_truong, so_bao_danh, mon_chuyen_du_thi, nguyen_vong_1, nguyen_vong_2, hanh_kiem_hoc_luc_6, hanh_kiem_hoc_luc_7, hanh_kiem_hoc_luc_8, hanh_kiem_hoc_luc_1_9, loai_tot_nghiep_thcs, diem_tb_mon_chuyen, diem_tb_lop_9, diem_tb_toan_lop_9, diem_tb_van_lop_9, diem_tb_ngoai_ngu_lop_9, ten_ngoai_ngu)
VALUES
(1, 'Nguyen Van A', 'male', '2005-04-12', 'Kinh', '12', 'Le Loi', 'Phuong 1', 'Hanoi', 'Hanoi', '0123456789', '0987654321', 'THCS Nguyen Trai', 'Hanoi', 'Hanoi', 123456, 'Toan', 'Chuyen Toan', 'Chuyen Ly', 'Tot', 'Tot', 'Kha', 'Kha', 'Gioi', 9.0, 8.5, 9.0, 8.0, 8.5, 'Anh'),
(2, 'Tran Thi B', 'female', '2005-06-23', 'Kinh', '45', 'Tran Phu', 'Phuong 2', 'HCMC', 'HCMC', '0912345678', '0923456789', 'THCS Le Quy Don', 'HCMC', 'HCMC', 223456, 'Ly', 'Chuyen Ly', 'Chuyen Toan', 'Tot', 'Tot', 'Kha', 'Kha', 'Gioi', 8.8, 8.2, 9.1, 7.5, 8.3, 'Anh'),
(3, 'Le Van C', 'male', '2005-09-01', 'Kinh', '23', 'Hai Ba Trung', 'Phuong 3', 'Da Nang', 'Da Nang', '0933445566', '0944556677', 'THCS Tran Cao Van', 'Da Nang', 'Da Nang', 323456, 'Van', 'Chuyen Van', 'Chuyen Su', 'Kha', 'Kha', 'Tot', 'Kha', 'Gioi', 8.5, 8.3, 7.9, 8.8, 9.0, 'Anh'),
(4, 'Pham Thi D', 'female', '2005-10-15', 'Kinh', '67', 'Quang Trung', 'Phuong 4', 'Hue', 'Thua Thien Hue', '0955667788', '0966778899', 'THCS Nguyen Hue', 'Hue', 'Thua Thien Hue', 423456, 'Su', 'Chuyen Su', 'Chuyen Dia', 'Tot', 'Tot', 'Kha', 'Tot', 'Gioi', 8.7, 8.6, 8.0, 9.1, 8.4, 'Anh'),
(5, 'Nguyen Thi E', 'female', '2005-11-02', 'Kinh', '34', 'Phan Boi Chau', 'Phuong 5', 'Hai Phong', 'Hai Phong', '0977889900', '0988990011', 'THCS Nguyen Duc Canh', 'Hai Phong', 'Hai Phong', 523456, 'Dia', 'Chuyen Dia', 'Chuyen Van', 'Tot', 'Tot', 'Kha', 'Tot', 'Gioi', 8.9, 8.4, 9.2, 8.5, 8.9, 'Phap'),
(6, 'Tran Van F', 'male', '2005-03-12', 'Kinh', '56', 'Le Loi', 'Phuong 6', 'Ha Long', 'Quang Ninh', '0988990022', '0911223344', 'THCS Hong Gai', 'Ha Long', 'Quang Ninh', 623456, 'Toan', 'Chuyen Toan', 'Chuyen Ly', 'Tot', 'Tot', 'Kha', 'Tot', 'Gioi', 9.2, 9.0, 9.4, 8.7, 8.8, 'Nga'),
(7, 'Hoang Thi G', 'female', '2005-05-19', 'Kinh', '22', 'Le Thanh Tong', 'Phuong 7', 'Hai Duong', 'Hai Duong', '0933665588', '0944776699', 'THCS Tran Hung Dao', 'Hai Duong', 'Hai Duong', 723456, 'Toan', 'Chuyen Toan', 'Chuyen Hoa', 'Tot', 'Tot', 'Kha', 'Kha', 'Gioi', 9.1, 8.8, 9.5, 8.6, 8.7, 'Anh'),
(8, 'Nguyen Van H', 'male', '2005-07-30', 'Kinh', '89', 'Ly Thuong Kiet', 'Phuong 8', 'Nam Dinh', 'Nam Dinh', '0909090909', '0910111213', 'THCS Ngo Quyen', 'Nam Dinh', 'Nam Dinh', 823456, 'Hoa', 'Chuyen Hoa', 'Chuyen Ly', 'Tot', 'Tot', 'Tot', 'Tot', 'Gioi', 9.3, 9.1, 9.6, 8.9, 8.8, 'Anh'),
(9, 'Do Thi I', 'female', '2005-08-25', 'Kinh', '32', 'Tran Hung Dao', 'Phuong 9', 'Ninh Binh', 'Ninh Binh', '0911222333', '0911222334', 'THCS Le Van Tam', 'Ninh Binh', 'Ninh Binh', 923456, 'Van', 'Chuyen Van', 'Chuyen Su', 'Tot', 'Tot', 'Tot', 'Tot', 'Gioi', 8.6, 8.4, 9.0, 8.3, 8.7, 'Phap'),
(10, 'Pham Van J', 'male', '2005-12-11', 'Kinh', '45', 'Phan Dinh Phung', 'Phuong 10', 'Thanh Hoa', 'Thanh Hoa', '0901234567', '0922345678', 'THCS Nguyen Van Troi', 'Thanh Hoa', 'Thanh Hoa', 1023456, 'Su', 'Chuyen Su', 'Chuyen Dia', 'Tot', 'Tot', 'Tot', 'Kha', 'Gioi', 8.7, 8.5, 8.2, 8.4, 8.6, 'Anh');


INSERT INTO trang_thai_ho_so (trang_thai_ho_so_id, trang_thai_ho_so, thong_tin_nguoi_cap_nhat, ghi_chu)
VALUES
(1, 'ChoDuyet', 'Nguyen Van A', 'Chờ xét duyệt hồ sơ.'),
(2, 'ChoDuyet', 'Tran Thi B', 'Hồ sơ đã được duyệt.'),
(3, 'ChoDuyet', 'Le Van C', 'Hồ sơ bị từ chối do thông tin không chính xác.'),
(4, 'ChoDuyet', 'Pham Thi D', 'Yêu cầu chỉnh sửa thông tin hồ sơ.'),
(5, 'ChoDuyet', 'Nguyen Thi E', 'Chờ xét duyệt hồ sơ.'),
(6, 'ChoDuyet', 'Tran Van F', 'Hồ sơ đã được duyệt.'),
(7, 'ChoDuyet', 'Hoang Thi G', 'Hồ sơ bị từ chối do thiếu thông tin.'),
(8, 'ChoDuyet', 'Nguyen Van H', 'Yêu cầu chỉnh sửa thông tin liên lạc.'),
(9, 'ChoDuyet', 'Do Thi I', 'Chờ xét duyệt hồ sơ.'),
(10, 'ChoDuyet', 'Pham Van J', 'Hồ sơ đã được duyệt.');
