function compareStrPwd() {
    var string1 = document.getElementById("password").innerHTML;
    var string2 = document.getElementById("repassword").innerHTML;
    var result = string1.localeCompare(string2);

    console.log(result,'H');

    document.getElementById("error").innerHTML = result;
}