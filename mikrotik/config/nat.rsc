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