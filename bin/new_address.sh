buffer="$(date +'%d-%m-%Y-%T')"
buffer+=$'\n'


function log {
  echo $1
  buffer+=$1
  buffer+=$'\n'
}
function flush {
  echo "$buffer" >> log.txt
  buffer=""
}

log "Entrer la ville"
read ville
log "$ville"

log "Entrer le code postal"
read cp
log "$cp"

flush

php.exe create_address.php $ville $cp  | xargs -I{} echo {} >> log.txt

read -rp "Press enter to exit"


