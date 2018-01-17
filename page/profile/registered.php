<?php

function getProfileData(): array
{
    $statement = prepareAndExecute(
        "SELECT 
            firstname as voornaam,
            lastname as achternaam,
            country_name as land,
            gender as geslacht,
            birth_date as geboortedatum,
            user_name as gebruikersnaam,
            customer_mail_address as email,
            payment_method as betaalmethode,
            payment_card_number as [kaart nummer],
            contract_type as abbonement,
            subscription_start as startdatum,
            subscription_end as einddatum
        FROM Customer 
        WHERE customer_mail_address = :mailAddress",
        $_SESSION
    );
    return $statement->fetch(PDO::FETCH_ASSOC);
}

$userdata = getProfileData();
$userdataFieldValues = [
    "land"          => makeCountryInput($userdata['land']),
    "geslacht"      => makeGenderInput($userdata['geslacht']),
    "betaalmethode" => makePaymentMethodInput($userdata['betaalmethode']),
    "abbonement"    => makeContractInput($userdata['abbonement']),
];

echo "
<main class='page-content'>
    <div class='content'> <!-- Validator zit te zeuren over missende h2-h6 bij article -->

    <form action='.' method='post'>";
foreach ($userdata as $key => $value) {
    if (isset($userdataFieldValues[$key])) {
        echo $userdataFieldValues[$key];
    }
    else {
        echo makeInput($key, ucfirst($key), 'text', $value);
    }
}

echo "
            <input type='submit' value='Wijzig gegevens'>
        </form>
    </div>
</main>";