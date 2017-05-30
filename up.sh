HOST="ftp.nippovinifantini.com"
USER="nippo_ad_17"
PASS="asrta5%25ady77"
# asrta5%ady77 the % needs escaping
FTPURL="ftp://$USER:$PASS@$HOST"
LCD="~/PhpstormProjects/newsite/wp-content/themes/nippo"
RCD="/httpdocs/newsite/wp-content/themes/nippo"
#DELETE="--delete"
lftp -c "set ftp:list-options -a;
open '$FTPURL';
lcd $LCD;
cd $RCD;
mirror --reverse \
     $DELETE \
       --verbose \
       --exclude-glob media/ \
       --exclude-glob smtp/ \
       --exclude-glob themes/ \
       --exclude-glob css/font-awesome-4.7.0/ \
       --exclude-glob .DS_Store \
       --exclude-glob a-file-to-exclude \
       --exclude-glob a-file-group-to-exclude* \
       --exclude-glob other-files-to-exclude"

