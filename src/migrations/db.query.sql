
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