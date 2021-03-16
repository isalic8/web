#!/usr/bin/env sh
clear
search_list="$HOME/.w3m/cgi-bin/search.txt"
PREFIX=$(cat "$search_list" | cut -d ';' -f1 | fzf --height 15 --header="Search")
[ -z "$PREFIX" ] && exit
read -p "Search term: " INPUT

PREFIX=$(grep -w "$PREFIX" "$search_list" | cut -d';' -f2)
INPUT=$(echo "$INPUT" | tr ' ' '+')
echo -n "${PREFIX}${INPUT}" | xclip -selection clipboard
