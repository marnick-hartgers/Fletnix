<?php

$errormsg = "";

function handleRegisterPostParameters()
{
    if (count($_POST) == 0) {
        return;
    }
    global $errormsg;
    $requiredFields = [
        "firstName",
        "lastName",
        "gender",
        "birthDate",
        "country",
        "contract",
        "payment_method",
        "cardnumber",
        "email",
        "username",
        "password",
        "passwordCheck",
    ];
    $returnCode = MISSING_FIELDS;
    if (allFieldsArePresent($requiredFields,
        $_POST)) {
        if ($_POST['password'] != $_POST['passwordCheck']) {
            $returnCode = PASSWORDS_NO_MATCH;
        } else {
            $returnCode = registerUser($_POST);
        }
    }

    switch ($returnCode) {
        case DATABASE_ERROR:
            echo "something wrong in database";
        break;
        case MISSING_FIELDS:
            echo "One or more fields are missing";
        break;
        case PASSWORDS_NO_MATCH:
            $errormsg = "passwords don't match";
        break;
        case EMAIL_EXISTS:
            $errormsg = "email address already exists";
        break;
        case ALL_OK:
            setUserSession($_POST['email']);
        break;
        default:
            echo "something else";
        break;
    }
}

handleRegisterPostParameters();

$requestedFields = [
    "firstName"      => [
        "type"  => "text",
        "label" => "Voornaam",
    ],
    "lastName"       => [
        "type"  => "text",
        "label" => "Achternaam",
    ],
    "gender"         => makeGenderInput(),
    "birthDate"      => [
        "type"  => "date",
        "label" => "Geboortedatum",
    ],
    "country"        => makeCountryInput(),
    "subscription"   => makeContractInput(),
    "payment_method" => makePaymentMethodInput(),
    "cardnumber"     => [
        "type"  => "text",
        "label" => "Kaartnummer",
    ],
    "email"          => [
        "type"  => "email",
        "label" => "Email adres",
    ],
    "username"       => [
        "type"  => "text",
        "label" => "Gebruikersnaam",
    ],
    "password"       => [
        "type"  => "password",
        "label" => "Wachtwoord",
    ],
    "passwordCheck"  => [
        "type"  => "password",
        "label" => "Herhaal wachtwoord",
    ],
];

echo "
        <main class='page-content'>
            <div class='content'> <!-- Validator zit te zeuren over missende h2-h6 bij article -->
            {$errormsg}
                <form method='post' action='#'>";

foreach ($requestedFields as $name => $field) {
    if (is_array($field)) {
        echo makeInput($name, $field['label'], $field["type"]);
    } else {
        echo $field;
    }
}

echo "
                    <div class='submit_input'><input type='submit' value='Registreer'></div>
                </form>
            </div>
        </main>
    </body>
</html>";
