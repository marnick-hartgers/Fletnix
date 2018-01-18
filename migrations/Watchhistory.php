<?php

function convertWatchHistoryColumns() {
    $columns = getColumnInfo("Watchhistory");
    if (strtolower($columns['watch_date']['type']) == "date") {
        getPdo()->query("
            ALTER TABLE Watchhistory
                DROP CONSTRAINT IF EXISTS PK_Movie_Watchhistory_1;
            ALTER TABLE Watchhistory
                    ALTER COLUMN watch_date DATETIME NOT NULL;
            ALTER TABLE Watchhistory
                    ALTER COLUMN movie_id INT NOT NULL;
            ALTER TABLE Watchhistory
                    ALTER COLUMN customer_mail_address VARCHAR(255) NOT NULL;
            ALTER TABLE Watchhistory
                    ADD CONSTRAINT PK_Watchhistory PRIMARY KEY (movie_id, customer_mail_address, watch_date)");
        convertCustomerPasswords();
    }
}