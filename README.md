# 본격 라라벨 공부

- Window 10, Mac.
- homestead.
- laravel 5.8.

## homestead
```
---
ip: "192.168.10.10"
memory: 2048
cpus: 2
provider: virtualbox

authorize: ~/.ssh/id_rsa.pub

keys:
    - ~/.ssh/id_rsa

folders:
    - map: /Users/sjahn/workspace
      to: /home/vagrant/Code

sites:
    - map: laravel.homestead.test
      to: /home/vagrant/Code/laravel.homestead.test/public


databases:
    - homestead

features:
    - mariadb: false
    - ohmyzsh: false
    - webdriver: false

# ports:
#     - send: 50000
#       to: 5000
#     - send: 7777
#       to: 777
#       protocol: udp
```
