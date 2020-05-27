# RESTful-API-JWT

Membangun RESTful API menggunaan CI 4 dan otorisasi JWT.

## Instalasi

Clone proyek ini dengan perintah:

```bash
git clone https://github.com/banguncode/RESTful-API-JWT.git
```

## Penggunaan

1. Buat database baru, contoh: db_restful_jwt

2. Buka file .env dan sesuaikan konfigurasi database

```env
database.default.hostname = localhost
database.default.database = db_restful_jwt
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```

3. Sekarang kita manfaatkan [Spark](https://spark.apache.org/), jalankan migrasi terhadap database

```bash
php spark migrate
```

4. Jalankan seeder yang ditentukan untuk mengisi data ke dalam database, dalam hal ini yaitu UserSeeder


```bash
php spark db:seed UserSeeder
```

5. Jalankan server

```bash
start http://localhost:8080; php spark serve
```

6. Buka [Postman](https://www.postman.com/), untuk mendapatkan token terbaru lakukan proses login dengan menyesuaikan:
- Host/endpoint: `http://localhost:8080/auth/check_login`
- Method: `POST`
- Param: `user` : `rum.haidar@hotmail.com`, `pass` : `rahasia`

7. Jika berhasil maka hasilnya akan seperti berikut:

![N|Solid](https://raw.githubusercontent.com/banguncode/RESTful-API-JWT/master/screenshot/GetToken.PNG)

8. Coba akses data user dengan menyesuaikan:
- Host/endpoint: `http://localhost:8080/users`
- Method: `GET`
- Header: `Authorization` : `token yang telah didapat`

9. Jika berhasil maka hasilnya akan seperti berikut:

![N|Solid](https://raw.githubusercontent.com/banguncode/RESTful-API-JWT/master/screenshot/GetUsers.PNG)

10. Selesai

## Kontribusi

Pull requests dipersilakan. Untuk perubahan besar, harap buka issue terlebih dahulu untuk membahas apa yang ingin diubah.

## License
[GNU AGPLv3 ](https://choosealicense.com/licenses/gpl-3.0/)
