function mascaraMutuario(o, f) {
    v_obj = o
    v_fun = f
    setTimeout('execmascara()', 1)
    }
    function execmascara() {
    v_obj.value = v_fun(v_obj.value)
    }
    function cpfCnpj(v) {
    v = v.replace(/\D/g, "")
    if (v.length <= 11) {
    v = v.replace(/(\d{3})(\d)/, "$1.$2")
    v = v.replace(/(\d{3})(\d)/, "$1.$2")
    v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2")
    } else { 
    v = v.replace(/^(\d{2})(\d)/, "$1.$2")        
    v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3")     
    v = v.replace(/\.(\d{3})(\d)/, ".$1/$2")       
    v = v.replace(/(\d{4})(\d)/, "$1-$2")
    }
    return v
    }

var aux = document.getElementById('cpf_cnpj');
aux.onkeypress = function() {
mascaraMutuario(this, cpfCnpj);
}
aux.maxLength = 18;