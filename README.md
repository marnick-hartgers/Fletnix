##Base folder
De base folder, en alles wat er in zit, wordt door de includeDir functie geladen.

##Page folder
Per request wordt een enkele page folder geladen. Welke folder wordt geladen wordt bepaald door de url. 
Wanneer een url niet matcht met een van de page folders zal index/index.php geladen worden

Bijvoorbeeld: met de volgende url `http://fletnix/browse` zal `page/browse/browse.php` geladen worden