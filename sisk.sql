/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     1/7/2012 8:17:02 PM                          */
/*==============================================================*/


drop table if exists BAGIAN;

drop table if exists CALON_PEGAWAI;

drop table if exists KRITERIA;

drop table if exists NILAI_PEGAWAI_PER_PERTANYAAN;

drop table if exists PENILAIAN;

drop table if exists PERTANYAAN;

drop table if exists SUBKRITERIA;

drop table if exists USER;

/*==============================================================*/
/* Table: BAGIAN                                                */
/*==============================================================*/
create table BAGIAN
(
   BAGIAN_ID            int not null,
   NAMA_BAGIAN          varchar(255),
   NILAI_MINIMUM        decimal(10,2),
   primary key (BAGIAN_ID)
);

/*==============================================================*/
/* Table: CALON_PEGAWAI                                         */
/*==============================================================*/
create table CALON_PEGAWAI
(
   CAPEG_ID             int not null,
   NAMA_CAPEG           varchar(255),
   STATUS_PEGAWAI       numeric(1,0),
   primary key (CAPEG_ID)
);

/*==============================================================*/
/* Table: KRITERIA                                              */
/*==============================================================*/
create table KRITERIA
(
   KRITERIA_ID          int not null,
   NAMA_KRITERIA        varchar(255),
   PRIORITAS_KRITERIA   numeric(10,3),
   primary key (KRITERIA_ID)
);

/*==============================================================*/
/* Table: NILAI_PEGAWAI_PER_PERTANYAAN                          */
/*==============================================================*/
create table NILAI_PEGAWAI_PER_PERTANYAAN
(
   NILAI_PEG_PERTANYAAN_ID int not null,
   PERTANYAAN_ID        int,
   CAPEG_ID             int,
   NILAI                int,
   primary key (NILAI_PEG_PERTANYAAN_ID)
);

/*==============================================================*/
/* Table: PENILAIAN                                             */
/*==============================================================*/
create table PENILAIAN
(
   PENILAIAN_ID         int not null,
   KRITERIA_ID          int,
   SUBKRITERIA_ID       int,
   BAGIAN_ID            int,
   CAPEG_ID             int,
   primary key (PENILAIAN_ID)
);

/*==============================================================*/
/* Table: PERTANYAAN                                            */
/*==============================================================*/
create table PERTANYAAN
(
   PERTANYAAN_ID        int not null,
   BAGIAN_ID            int,
   KRITERIA_ID          int,
   NAMA_PERTANYAAN      varchar(255),
   primary key (PERTANYAAN_ID)
);

/*==============================================================*/
/* Table: SUBKRITERIA                                           */
/*==============================================================*/
create table SUBKRITERIA
(
   SUBKRITERIA_ID       int not null,
   NAMA_SUBKRITERIA     varchar(255),
   PRIORITAS_SUBKRITERIA decimal(10,3),
   BOBOT                int,
   primary key (SUBKRITERIA_ID)
);

/*==============================================================*/
/* Table: USER                                                  */
/*==============================================================*/
create table USER
(
   USERID               int not null,
   NAMA                 varchar(255),
   KODEROLE             numeric(1,0),
   USERNAME             varchar(255),
   PASSWORD             varchar(255),
   STATUS_USER          numeric(1,0),
   primary key (USERID)
);

alter table NILAI_PEGAWAI_PER_PERTANYAAN add constraint FK_RELATIONSHIP_7 foreign key (CAPEG_ID)
      references CALON_PEGAWAI (CAPEG_ID) on delete restrict on update restrict;

alter table NILAI_PEGAWAI_PER_PERTANYAAN add constraint FK_RELATIONSHIP_9 foreign key (PERTANYAAN_ID)
      references PERTANYAAN (PERTANYAAN_ID) on delete restrict on update restrict;

alter table PENILAIAN add constraint FK_RELATIONSHIP_1 foreign key (KRITERIA_ID)
      references KRITERIA (KRITERIA_ID) on delete restrict on update restrict;

alter table PENILAIAN add constraint FK_RELATIONSHIP_2 foreign key (CAPEG_ID)
      references CALON_PEGAWAI (CAPEG_ID) on delete restrict on update restrict;

alter table PENILAIAN add constraint FK_RELATIONSHIP_3 foreign key (SUBKRITERIA_ID)
      references SUBKRITERIA (SUBKRITERIA_ID) on delete restrict on update restrict;

alter table PENILAIAN add constraint FK_RELATIONSHIP_4 foreign key (BAGIAN_ID)
      references BAGIAN (BAGIAN_ID) on delete restrict on update restrict;

alter table PERTANYAAN add constraint FK_RELATIONSHIP_5 foreign key (KRITERIA_ID)
      references KRITERIA (KRITERIA_ID) on delete restrict on update restrict;

alter table PERTANYAAN add constraint FK_RELATIONSHIP_8 foreign key (BAGIAN_ID)
      references BAGIAN (BAGIAN_ID) on delete restrict on update restrict;

