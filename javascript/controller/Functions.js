//function for modifying the query params
export const insertUrlParam = (key, value) => {
    if (history.pushState) {
        let searchParams = new URLSearchParams(window.location.search);
        searchParams.set(key, value);
        let newurl =
            window.location.protocol +
            "//" +
            window.location.host +
            window.location.pathname +
            "?" +
            searchParams.toString();
        window.history.pushState({ path: newurl }, "", newurl);
    }
};

export const getUrlVars = () => /// מחזיר לך את הפרמטרים ב url
    {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,
            function(m, key, value) {
                vars[key] = value;
            });
        return vars;
    }

export const formatForm = (form) => {
    var formData = {};
    $(form).find(':not([type=checkbox])[name]').each(function() {
        formData[this.name] = $(this).val();
    })
    $('form').find('input:checkbox[name]:checked').each(function() {
        if (!formData[this.name]) {
            formData[this.name] = "";
        }
        formData[this.name] += this.value + ",";
    });

    return formData;
}

export const showLoading = (_msg = "טוען נתונים") => {
    Swal.fire({
        html: "<center>"+ _msg +"<br><i class='fa fa-spinner fa-spin fa-5x' aria-hidden='true'></i></center>",
        showConfirmButton: false
    });
    return false;
}
export const HideLoading = () => {
    Swal.close();
    return false;
}


//format time
export const format = (date) => {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    // var ampm = hours >= 12 ? "pm" : "am";
    // hours = hours % 12;
    // hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? "0" + minutes : minutes;
    var strTime = hours + ":" + minutes;
    return (
        strTime +
        "  " +
        date.getDate() +
        "/" +
        (date.getMonth() + 1) +
        "/" +
        date.getFullYear()
    );
};

export function showModal(_title="כותרת",_body="",_command="none")///פותח מודל
{
    let modal = $(".modal");
    if(modal.length)
    {
        console.log(modal);
        $("#close_box").attr("data-command",_command);
        $(".modal-body").html(_body);
        $(".modalTitle").html(_title);
        $(".modal").modal("show");
    }
    else
    {
        let newModal = document.createElement("div");
        newModal.className = "modal fade";
        $(newModal).attr("data-backdrop","static");
        $(newModal).attr("tabindex","-1");
        $(newModal).attr("role","dialog");
        $(newModal).attr("aria-hidden","true");
        newModal.innerHTML=`
        <div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" style="position:absolute;right:12px;top:10px;" data-command='${_command}' id="close_box" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h2 class="text-center modalTitle">${_title}</h2>
			</div>
			<div class="modal-body text-right">
			${_body}
			</div>
		</div>
	</div>
        `;
        $(".content-wrapper").prepend(newModal);
        $(".modal").modal("show");
    }
}