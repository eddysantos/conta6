	var NativeMode = false;
	var DecSep = ",";
	var MaxPrecision = 20;
    
	function parseFloat2(a) {
		a += '';
		if (DecSep != ".") {
			a = a.replace(DecSep, ".")
		}
		var f = parseFloat(a);
		return (f)
	}
	
	function mulDecimal(a, b) {
		var c = getDecimalPart(a).length,
			l2 = getDecimalPart(b).length,
			places = c + l2,
			v = a * b;
		return parseFloat(v.toFixed(places > MaxPrecision ? MaxPrecision : places))
	}
	
	function getDecimalPart(a) {
		var b = a.toString().split('.');
		return (b[1] === undefined ? "" : b[1])
	}
	
	function addDecimal(a, b) {
		var c = getDecimalPart(a).length,
			l2 = getDecimalPart(b).length,
			places = c > l2 ? c : l2,
			v = a + b;
		return parseFloat(v.toFixed(places > MaxPrecision ? MaxPrecision : places))
	}
	
	function subDecimal(a, b) {
		var c = getDecimalPart(a).length,
			l2 = getDecimalPart(b).length,
			places = c > l2 ? c : l2,
			v = a - b;
		return parseFloat(v.toFixed(places > MaxPrecision ? MaxPrecision : places))
	}
	
/* MULTIPLICAR a=acumulado */
	function CalcMUL(a, b) {
		return ((NativeMode) ? (parseFloat2(a) * parseFloat2(b)) : mulDecimal(parseFloat2(a), parseFloat2(b)))
	}
	
/* SUMAR a=acumulado */	
	function CalcADD(a, b) {
		return ((NativeMode) ? (parseFloat2(a) + parseFloat2(b)) : addDecimal(parseFloat2(a), parseFloat2(b)))
	}

/* RESTA a=acumulado */
	function CalcSUB(a, b) {
		return ((NativeMode) ? (parseFloat2(a) - parseFloat2(b)) : subDecimal(parseFloat2(a), parseFloat2(b)))
	}