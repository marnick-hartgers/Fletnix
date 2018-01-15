<?php

function handleRegisterPostParameters() {
    $requiredFields = [
        "firstName",
        "lastName",
        "subscription",
        "birthDate",
        "username",
        "country",
        "payment_method",
        "gender",
        "password",
        "passwordCheck"
    ];
    $returnCode = MISSING_FIELDS;
    if (allFieldsArePresent($requiredFields, $_POST)) {
        if ($_POST['password'] != $_POST['passwordCheck']) {
            $returnCode = PASSWORDS_NO_MATCH;
        }
        else {
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
            echo "passwords don't match";
        break;
        case EMAIL_EXISTS:
            echo "email address already exists";
        break;

        case ALL_OK:
            handleLoginPostParameters();
        break;
        default:
        break;
    }
}

handleRegisterPostParameters();

echo  "
        <main class='page-content'>
            <div class='content'> <!-- Validator zit te zeuren over missende h2-h6 bij article -->

                <p>Er zijn op het moment 3 verschillende abonnementen beschikbaar: MaxiNix, PreNix en PostNix</p>
                <div class='flex '>
                    <section class='subscription_block background-color1'>
                        <h2>MaxiNix</h2>
                        <p>Dit pakket bied de mogelijkheid om onbeperkt films te kijken tegen een enkele vaste prijs(&euro; 100,-).
                            Dit pakket is speciaal voor mensen die veel films kijken</p>
                    </section>
                    <section class='subscription_block background-color1'>
                        <h2>PreNix</h2>
                        <p>Dit is het prepaid pakket van NetNix. Voor het kijken van een film word er een credit verrekend.
Op elk moment is het mogelijk om credits te kopen(&euro; 1,- voor 10 credits)</p>
                    </section>
                    <section class='subscription_block background-color1'>
                        <h2>PostNix</h2>
                        <p>Dit is het postpaid pakket van NetNix. Elke film die wordt bekeken word aan het eind van de maand verrekend.
(&euro; 0,20 per film).
                            </p>
                    </section>
                </div>
            </div>
            <div class='content'> <!-- Validator zit te zeuren over missende h2-h6 bij article -->
                <form method='post' action='#'>
                    <table>
                        <tr>
                            <td><label for='firstName'>Voor- en achternaam</label></td>
                            <td><input type='text' id='firstName' tabindex='1'> <input type='text' id='lastName' tabindex='2'></td>
                            <td colspan='2'>".makeContractInput()."</td>
                        </tr>
                        <tr>
                        <tr>
                            <td><label for='birthDate'>Geboortedatum</label></td>
                            <td><input type='date' id='birthDate' tabindex='3'></td>
                            <td><label for='username'>Gebruikersnaam</label></td>
                            <td><input type='text' id='username' tabindex='7'></td>
                        </tr>
                        <tr>
                            <td colspan='2'>".makeCountryInput()."</td>
                            <td><label for='password'>Wachtwoord</label></td>
                            <td><input type='password' id='password' tabindex='8'></td>
                        </tr>
                        <tr>
                            <td><label for='cardNumber'>/label></td>
                            <td><input type='text' id='cardNumber' tabindex='5'></td>
                            <td><label for='passwordCheck'>Wachtwoord</label></td>
                            <td><input type='password' id='passwordCheck' tabindex='9'></td>
                        </tr>
                        <tr>
                            <td colspan='2'>".makePaymentMethodInput()."</td>
                            <td><label for='email'>Email adress</label></td>
                            <td><input type='text' id='email' tabindex='6'></td>
                        </tr>
                        <tr>
                            <td colspan='2'>".makeGenderInput()."</td>
                        </tr>
                        <tr>
                            <td colspan='2'></td>
                            <td colspan='2'><input type='submit' value='Registreren' tabindex='10'></td>
                        </tr>
                    </table>
                </form>
            </div>
        </main>
    </body>
</html>";
