function putSessionVariable(keyData, valueData) {
	var formData = {
		key: keyData,
		value: valueData
	};

	$.ajax({
		type: "POST",
		url: '/session',
		data: formData,
		success: function(data, textStatus, jqXHR) {
			return true;
		},
		error: function(data){
			return data;
	    }
	});
}
//# sourceMappingURL=resources.js.map