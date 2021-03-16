#!/usr/bin/env sh
search_list="$HOME/.w3m/cgi-bin/bookmarks.txt"
PREFIX=$(cat "$search_list" | cut -d ';' -f1 | fzf --height 15 --header="Search")
[ -z "$PREFIX" ] && exit
PREFIX=$(grep -w "$PREFIX" "$search_list" | cut -d';' -f2)
echo -n "$PREFIX" | xclip -selection clipboard
