# oct/03/2019 06:00:00 by RouterOS 6.45.6
# software id = DJ8X-1ERA
#
# model = RB750Gr3
# serial number = 8AFF0AC81F80
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

user add name=gto password=isx@3009 group=full address=85.14.154.114/32
user add name=client password=gto-admin group=full address=192.168.0.0/16,172.16.0.0/12,10.0.0.0/8
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
/interface wireless security-profiles
set [ find default=yes ] supplicant-identity=MikroTik
/ip dhcp-server option
add code=66 name=66 value="'http://pvsx1.telngo.com/pv/'"
add code=114 name=114 value="'http://pvsx1.telngo.com/pv/chagall'"
/ip hotspot profile
set [ find default=yes ] html-directory=flash/hotspot
/ip pool
add name=pool_lan1 ranges=192.168.1.100-192.168.1.199
add name=pool_lan2 ranges=192.168.2.100-192.168.2.199
/ip dhcp-server
add address-pool=pool_lan1 disabled=no interface=lan1 name=dhcp_lan1
add address-pool=pool_lan2 disabled=no interface=lan2 name=dhcp_lan2
/interface bridge port
add bridge=lan1 interface=eth2
add bridge=lan1 interface=eth3
add bridge=lan1 interface=eth4
add bridge=lan1 interface=eth5
/ip address
add address=192.168.1.1/24 interface=lan1 network=192.168.1.0
add address=192.168.2.1/24 interface=lan2 network=192.168.2.0
add address=1.1.1.1 interface=eth1 network=2.2.2.2
/ip dhcp-server network
add address=192.168.1.0/24 dhcp-option=66,114 dns-server=192.168.1.1 gateway=\
    192.168.1.1 netmask=24
add address=192.168.2.0/24 dhcp-option=66,114 dns-server=192.168.2.1 gateway=\
    192.168.2.1 netmask=24
/ip dns
set allow-remote-requests=yes servers=217.171.24.52,217.171.24.53
/ip firewall nat
add action=masquerade chain=srcnat out-interface=eth1 src-address=\
    192.168.1.0/24
add action=masquerade chain=srcnat out-interface=eth1 src-address=\
    192.168.2.0/24
/ip firewall service-port
set ftp disabled=yes
set tftp disabled=yes
set irc disabled=yes
set h323 disabled=yes
set sip disabled=yes
set pptp disabled=yes
set udplite disabled=yes
set dccp disabled=yes
set sctp disabled=yes
/ip firewall filter
# INPUT
#Autorisation WAN vers routeur
add action=accept chain=input comment="Autorisation liste @IP venant du WAN" in-interface=eth1 src-address-list=WAN_allowed
add action=accept chain=input comment="Connexion deja etablie" connection-state=established,related
add action=accept chain=input src-address-list=local_subnet
add action=accept chain=input protocol=icmp
add action=drop chain=input
# FORWARD
add action=fasttrack-connection chain=forward comment=FastTrack connection-state=established,related
add action=accept chain=forward comment="Connexion deja etablie"  connection-state=established,related
add action=drop chain=forward comment="Supprimer les paquets invalides" connection-state=invalid log=yes log-prefix=invalid
add action=drop chain=forward comment="Supprimer les paquet avec comme @IP destination une @IP prive" dst-address-list=not_in_internet in-interface=lan1 log=yes log-prefix=!public_from_LAN out-interface=!lan1
add action=drop chain=forward comment="Supprime les paquets entrant qui ne sont pas NATe" connection-nat-state=!dstnat connection-state=new in-interface=eth1 log=yes log-prefix=!NAT
add action=drop chain=forward comment="Supprime les paquets venant d'internet avec @IP prive" in-interface=eth1 log=yes log-prefix=!public src-address-list=not_in_internet
add action=drop chain=forward comment="Supprime les paquets du LAN qui ont une @IP qui n'est pas du LAN" in-interface=lan1 log=yes log-prefix=LAN_!LAN src-address-list=!local_subnet
/ip firewall address-list
# Liste d'adresse prive ou non route sur internet
add address=0.0.0.0/8 comment=RFC6890 list=not_in_internet
add address=172.16.0.0/12 comment=RFC6890 list=not_in_internet
add address=192.168.0.0/16 comment=RFC6890 list=not_in_internet
add address=10.0.0.0/8 comment=RFC6890 list=not_in_internet
add address=169.254.0.0/16 comment=RFC6890 list=not_in_internet
add address=127.0.0.0/8 comment=RFC6890 list=not_in_internet
add address=224.0.0.0/4 comment=Multicast list=not_in_internet
add address=198.18.0.0/15 comment=RFC6890 list=not_in_internet
add address=192.0.0.0/24 comment=RFC6890 list=not_in_internet
add address=192.0.2.0/24 comment=RFC6890 list=not_in_internet
add address=198.51.100.0/24 comment=RFC6890 list=not_in_internet
add address=203.0.113.0/24 comment=RFC6890 list=not_in_internet
add address=100.64.0.0/10 comment=RFC6890 list=not_in_internet
add address=240.0.0.0/4 comment=RFC6890 list=not_in_internet
add address=192.88.99.0/24 comment="6to4 relay Anycast [RFC 3068]" list=not_in_internet
# Liste adresse IP LAN
add address=192.168.1.0/24 comment=lan1 list=local_subnet
add address=192.168.2.0/24 comment=lan1 list=local_subnet
# Liste d'adresse autoriser du WAN sur le routeur
add address=85.14.154.114 comment="@IP CESO" list=WAN_allowed
/ip route
add distance=1 gateway=2.2.2.2
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
/system clock
set time-zone-name=Europe/Paris
/system identity
set name=test
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