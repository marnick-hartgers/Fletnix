<?php

function makeInput(string $name = "", string $label = "Label", string $type = "text", $value = "")
{
    $elementId = GUID();

    return "
        <div class='text_input'>
            <input type='$type' name='$name' value='$value' id='$elementId' required='' />
            <label for='$elementId'>$label</label>
        </div>
    ";
}

function makeInputWithSubmit(string $name = "", string $label = "Label", string $buttonValue = "Verzend", string $type = "text", $value = "")
{
    $elementId = GUID();

    return "
        <div class='text_input text_input_with_submit'>
            <input type='$type' name='$name' value='$value' id='$elementId' required='' />
            <label for='$elementId'>$label</label>
            <input type='submit' class='search_button' value='$buttonValue'>
        </div>
    ";
}


function makeGenderInput($selectedValue = "", $name = "gender")
{
    $elementId = ["M" => GUID(), "F" => GUID()];
    $selected = [
        "M" => $selectedValue != "F" ? 'checked ' : "",
        "F" => $selectedValue == "F" ? 'checked ' : "",
    ];

    return "
        <div class='radio_input gender_input'>
            <label>Geslacht</label>
            <div>
                <input type='radio' name='gender' value='M' id='{$elementId["M"]}' required='' {$selected["M"]}/>
                <label for='{$elementId["M"]}'>Man</label>
                <input type='radio' name='gender' value='F' id='{$elementId["F"]}' required='' {$selected["F"]}/>
                <label for='{$elementId["F"]}'>Vrouw</label>
            </div>
        </div>
    ";
}

function makeCountryInput($selectedValue="", $name="country")
{
    $elementId = GUID();
    $options = "";
    if ($selectedValue != "") {
        $options.= "<option>$selectedValue</option>";
    }

    foreach (getCountries() as $country) {
        $options.= "<option>$country</option>";
    };

    return "
        <div class='select_input country_input'>
            <select id='$elementId' name='country'>$options</select>
            <label for='$elementId'>Land</label>
        </div>
    ";
}

function makePaymentMethodInput($selectedValue = "")
{
    $elementId = GUID();
    $options = "";

    if ($selectedValue != "") {
        $options .= "<option>$selectedValue</option>";
    }

    foreach (getPaymentMethods() as $method) {
        if ($method == $selectedValue) {
            continue;
        }
        $options .= "<option>$method</option>";
    };

    return "
        <div class='select_input payment_method_input'>
            <label for='$elementId'>Betaalmethode</label>
            <select id='$elementId' name='payment_method'>$options</select>
        </div>
        ";
}

function makeContractInput($selectedValue = "")
{
    $radios = "";

    foreach (getContracts() as $contract) {
        $elementId = GUID();
        $checked = "";
        if ($contract['contract'] == $selectedValue) {
            $checked = "checked";
        }
        $radios.= "
            <input type='radio' name='contract' value='{$contract['contract']}' id='$elementId' $checked required='' />
            <label for='$elementId'>".ucfirst($contract['contract']).": &euro; {$contract['price']}</label>";
    }

    return "
        <div class='radio_input contract_input'>
            <label>Abbonementen</label>
            <div>$radios</div>
        </div>
            
    ";
}