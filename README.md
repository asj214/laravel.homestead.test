# 본격 라라벨 공부

* Window 10, Mac
* homestead
* laravel 5.8

## 순서
* virtualbox 혹은 vm ware 설치
* [vagrant](https://www.vagrantup.com/downloads.html) 설치
* [homestead](https://github.com/laravel/homestead) 다운
* `homestead.yml` 작성
    * Windows: `Homestead.windows.yml` 파일 참고
    * Mac: `Homestead.mac.yml` 참고
* `hosts` 파일 수정

## vagrant command
* vagrant 실행: `vagrant up`
* vagrant 일시 중지: `vagrant suspend`
* vagrant 종료: `vagrant halt`
* vagrant ssh 접속: `vagrant ssh`
* homestead.yml 수정 후 적용 시킬때: `vagrant reload --provision`

## hosts 파일 수정
* Mac 위치: `/etc/hosts`
* Windows 위치: `C:\Windows\System32\drivers\etc\hosts`
```
192.168.10.10   laraval.homestead.test
```

## database
* 각자의 컴퓨터에서 접속 시
    ```
    host: 127.0.0.1
    port: 33060
    database: laravel.homestead.test
    username: homestead
    password: secret
    ```
* `.env` 파일 상에서
    ```
    host: 127.0.0.1
    port: 3306
    database: laravel.homestead.test
    username: homestead
    password: secret
    ```

## 초기 작업
1. 가상머신 실행 `vagrant up`
2. 가상머신 접속 `vagrant ssh`
3. laravel.homestead.test 경로로 이동 `cd /home/vagrant/Code/laravel.homestead.test/`
4. 패키지 설치 `composer update`
5. `.env` 파일에 database 정보 입력
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel.homestead.test
    DB_USERNAME=homestead
    DB_PASSWORD=secret
    ```
6. 마이그레이션 `artisan migrate`
7. 첨부파일 링크 설정: `artisan storage:link`
    >**참고**: Windows 환경에서는 cmd 창을 관리자 권한으로 실행 시킨 후 링크를 적용시켜야 가능하다.
8. `npm install`
9. `npm run dev` or `npm run prod`

## 알고있으면 도움되는 부분들
1. [Factory, Seed](https://github.com/asj214/laravel.homestead.test/blob/master/note/seeder.md)
2. [Gate](https://github.com/asj214/laravel.homestead.test/blob/master/note/gate.md)
3. [Socialite](https://github.com/asj214/laravel.homestead.test/blob/master/note/socialite.md)
4. [Resources](https://github.com/asj214/laravel.homestead.test/blob/master/note/resources.md)
5. [API사용자인증](https://github.com/asj214/laravel.homestead.test/blob/master/note/api_token.md)
6. [email 외 다른 컬럼으로 로그인](https://github.com/asj214/laravel.homestead.test/blob/master/note/authenticated.md)
7. [users, admins 세션 분리](https://github.com/asj214/laravel.homestead.test/blob/master/note/admin_session.md)
