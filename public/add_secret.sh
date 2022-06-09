#!/bin/bash

password=`echo -n $2 | iconv -f utf8 -t utf16le | openssl dgst -md4 | awk {'print $2'}`

echo "$1 : NTLM 0x$password" >> /etc/ipsec.secrets

sleep 3

ipsec secrets

