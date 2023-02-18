<?php

if(file_exists(BACKUP_FOLDER.$dumpFilename)) {
    unlink(BACKUP_FOLDER.$dumpFilename);
}