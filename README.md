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
