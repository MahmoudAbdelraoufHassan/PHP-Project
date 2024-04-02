create table listings(
    id int not null auto_increment primary key,
    user_id int not null,
    title varchar(255) not null,
    description longtext,
    category_id int not null,
    time_of_work varchar(15) not null,
    salary varchar(45),
    skills varchar(255),
    company varchar(45),
    address varchar(255),
    phone varchar(45),
    email varchar(45),
    requirements longtext,
    benefits longtext,
    picture varchar(255),
    created_at timestamp default current_timestamp,
    expire_date date
);
select * from listings;

alter table listings
add constraint fk_listings_users
foreign key(user_id ) references users(id)
on delete cascade 
on update cascade;
alter table listings
drop foreign key fk_listings_users;


alter table listings
add column active tinyint(1) default 1;

alter table listings
add constraint fk_listings_category
foreign key(category_id ) references categories(categ_id)
on delete cascade 
on update cascade;

alter table listings
drop foreign key fk_listings_category;

/* users table */

create table users(
    id int not null auto_increment primary key,
    fname varchar(255),
    lname varchar(255),
    email varchar(255) not null,
    password varchar(255) not null,
    user_type enum('employer' , 'applicant'),
    city varchar(45),
    gender varchar(10),
    birth_date varchar(25),
    picture varchar(255),
    created_at timestamp  default  current_timestamp
);

/* end users table */

/* application table */

create table applications(
    app_id int not null auto_increment primary key,
    listing_id int not null ,
    user_id int not null,
    organizer_id int not null,
    fname varchar(30) not null,
    email varchar(55) not null,
    phone varchar(45),
    pic varchar(255),
    cv varchar(255),
    status enum('0','1','2') default '0' ,
    created_at timestamp default current_timestamp
);

alter table applications
rename column fname  to applicant_name;

select * from applications inner join listings on applications.user_id = listings.user_id ;

select * from applications;

create table categories(
   categ_id int auto_increment not null primary key,
   ategory_name varchar(50)
);
insert into categories(ategory_name) values('Graphic & Design'),('Music & Audio'),('Code & Programing'),('Account & Finance'),('Digital Marketing'),('Healtategory_nameh & Care'),('Video & Animation'),('Data & Science');
select * from categories;


alter table applications
add constraint fk_to_listing
foreign key(listing_id ) references listings(id)
on delete cascade 
on update cascade;

alter table applications
drop foreign key fk_to_listing;

alter table applications
add constraint fk_to_user
foreign key(applicant_id ) references users(id)
on delete cascade 
on update cascade;

alter table applications
add constraint fk_to_company
foreign key(organizer_id ) references listings(user_id)
on delete cascade 
on update cascade;

alter table applications
drop foreign key fk_to_company;

alter table applications
drop foreign key fk_to_user;





delete from applications;















