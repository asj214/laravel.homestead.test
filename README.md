# 본격 라라벨 공부

* Window 10, Mac
* homestead
* laravel 5.8

## 순서
* virtualbox 혹은 vm ware 설치
* [vagrant](https://www.vagrantup.com/downloads.html) 설치
* [homestead](https://github.com/laravel/homestead) 다운
* `homestead.yml` 작성
* `hosts` 파일 수정

## vagrant command
```
# vagrant 실행
vagrant up

# vagrant 일시 중지
vagrant suspend

# vagrant 종료
vagrant halt

# vagrant ssh 접속
vagrant ssh

# homestead.yml 수정 후 적용 시킬때
vagrant reload --provision
```

## hosts 파일 수정
* Mac 위치: `/etc/hosts`
* Windows 위치: `C:\Windows\System32\drivers\etc\hosts`
```
192.168.10.10   laraval.homestead.test
```

## laravel 밑 작업
1. 가상머신 실행 `vagrant up`
2. 가상머신 접속 `vagrant ssh`
3. laravel.homestead.test 경로로 이동 `cd /home/vagrant/Code/laravel.homestead.test/`
4. 패키지 설치 `composer update`
5. `.env` 파일에 database 정보 입력
    ```
    host: 127.0.0.1
    port: 3306
    database: homestead
    username: homestead
    password: secret
    ```
6. 마이그레이션 `artisan migrate`
