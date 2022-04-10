# Simple VPN

Website to manage vpn accounts: http://niceyoureyes.ga/

Modules:
* Registration: entered login + password will be used for vpn authorization
* Authorization: enter to profile, some management if you are admin
* About: description and resolving issues

For vpn strongswan is used.
When user registers server calls some scripts to add user to vpn configuration (ipsec.secrets)
