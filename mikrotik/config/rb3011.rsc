# oct/02/2019 16:43:47 by RouterOS 6.45.6
# software id = P4WZ-H7GY
#
# model = RouterBOARD 3011UiAS
# serial number = B88D0AD24C1E
################################
#           COMMANDE           #
################################
# aaaaaaa -> affectation des interfaces au bridge
# ccccccc -> @IP Client
# ggggggg -> @IP Gateway
# nnnnnnn -> nom du routeur
# cesoces -> CESO User
# cesomdp -> CESO MDP
# locallo -> Local User
# localmd -> Local MDP
# #=#=#=#= -> Firewall et NAT

user add name=cesoceso password=CESOMDP group=full address=85.14.154.114/32
user add name=localloc password=localmdp group=full address=192.168.0.0/16,172.16.0.0/12,10.0.0.0/8
user remove admin
/interface bridge
add name=lan1
add name=lan2
/interface ethernet
set [ find default-name=ether1 ] name=eth1
set [ find default-name=ether2 ] name=eth2
set [ find default-name=ether3 ] name=eth3
set [ find default-name=ether4 ] name=eth4
set [ find default-name=ether5 ] name=eth5
set [ find default-name=ether6 ] name=eth6
set [ find default-name=ether7 ] name=eth7
set [ find default-name=ether8 ] name=eth8
set [ find default-name=ether9 ] name=eth9
set [ find default-name=ether10 ] name=eth10
set [ find default-name=sfp1 ] name=sfp
/interface wireless security-profiles
set [ find default=yes ] supplicant-identity=MikroTik
/ip dhcp-server option
add code=66 name=66 value="'http://pvsx1.telngo.com/pv/'"
add code=114 name=114 value="'http://pvsx1.telngo.com/pv/chagall'"
/ip pool
add name=pool_lan1 ranges=192.168.1.100-192.168.1.199
add name=pool_lan2 ranges=192.168.2.100-192.168.2.199
/ip dhcp-server
add address-pool=pool_lan1 disabled=no interface=lan1 name=dhcp_lan1
add address-pool=pool_lan2 disabled=no interface=lan2 name=dhcp_lan2
/interface bridge port
aaaaaaaa
/ip address
add address=192.168.1.1/24 interface=lan1 network=192.168.1.0
add address=192.168.2.1/24 interface=lan2 network=192.168.2.0
add address=cccccccc interface=eth1 network=gggggggg
/ip dhcp-server network
add address=192.168.1.0/24 dhcp-option=66,114 dns-server=192.168.1.1 gateway=\
    192.168.1.1 netmask=24
add address=192.168.2.0/24 dhcp-option=66,114 dns-server=192.168.2.1 gateway=\
    192.168.2.1 netmask=24
/ip dns
set allow-remote-requests=yes servers=217.171.24.52,217.171.24.53
#=#=#=#=#
/ip route
add distance=1 gateway=gggggggg
/ip service
set telnet disabled=yes
set ftp disabled=yes
set www disabled=yes
set ssh address=85.14.154.114/32,10.0.0.0/8,172.16.0.0/12,192.168.0.0/16
set api disabled=yes
set winbox address=85.14.154.114/32,10.0.0.0/8,172.16.0.0/12,192.168.0.0/16
set api-ssl disabled=yes
/tool mac-server set allowed-interface-list=none
/tool mac-server mac-winbox set allowed-interface-list=none
/tool mac-server ping set enabled=no
/ip ssh
set strong-crypto=yes forwarding-enabled=remote
/lcd
set backlight-timeout=never default-screen=stats touch-screen=disabled
/lcd interface
set eth2 disabled=yes
set eth3 disabled=yes
set eth4 disabled=yes
set eth5 disabled=yes
set sfp disabled=yes
set eth6 disabled=yes
set eth7 disabled=yes
set eth8 disabled=yes
set eth9 disabled=yes
set eth10 disabled=yes
/lcd screen
set 1 disabled=yes
set 2 disabled=yes
set 3 disabled=yes
set 4 disabled=yes
set 5 disabled=yes
/system clock
set time-zone-name=Europe/Paris
/system identity
set name=nnnnnnnn
/system note
set note="   ____                              _____    _                     \
    \_        \
    \n  / ___|_ __ ___  _   _ _ __   ___  |_   _|__| | ___  ___ ___  _ __ ___ \
    \____ \
    \n | |  _| '__/ _ \\| | | | '_ \\ / _ \\   | |/ _ \\ |/ _ \\/ __/ _ \\| '_\
    \_` _ \\/ __|\
    \n | |_| | | | (_) | |_| | |_) |  __/   | |  __/ |  __/ (_| (_) | | | | | \
    \\__ \\\
    \n  \\____|_|  \\___/ \\__,_| .__/ \\___|   |_|\\___|_|\\___|\\___\\___/|_\
    | |_| |_|___/\
    \n                       |_|                                              \
    \_    \
    \n\
    \n                  _          _   _    ___                  _   \
    \n               __| | ___    | | ( )  / _ \\ _   _  ___  ___| |_ \
    \n              / _` |/ _ \\   | | |/  | | | | | | |/ _ \\/ __| __|\
    \n             | (_| |  __/   | |     | |_| | |_| |  __/\\__ \\ |_ \
    \n              \\__,_|\\___|   |_|      \\___/ \\__,_|\\___||___/\\__|\
    \n                                                               "
/system ntp client
set enabled=yes primary-ntp=217.171.24.57 secondary-ntp=217.171.24.58
#==##==#
/tool e-mail
set address=relay.ceso-gto.com from=mikrotik@ceso-gto.com
