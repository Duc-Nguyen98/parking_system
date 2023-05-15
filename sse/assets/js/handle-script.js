function populateEntriesOptions() {
    var arrayShow = [5, 10, 20, 30, 40];
    arrayShow.forEach(function(value) {
        var option = $("<option value='" + value + "'>").text(value);
        $("#opEntries").append(option);
    });
}

// Gọi hàm populateEntriesOptions
populateEntriesOptions();


function separateDateAndTime(datetimeString) {
    if (datetimeString === '0000-00-00 00:00:00') {
        return {
            date: 'chưa xác định',
            time: 'chưa xác định'
        };
    } else {
        const timestamp = new Date(datetimeString).getTime();
        const date = new Date(timestamp).toLocaleDateString('vi-VN');
        const time = new Date(timestamp).toLocaleTimeString('vi-VN');
        return {
            date,
            time
        };
    }
}


function getParkArenaStatus(parkArenaCode) {
    switch (parkArenaCode) {
        case "1":
            return { classArena: "badge badge-primary text-uppercase" };
        case "2":
            return { classArena: "badge badge-warning text-uppercase" };
        default:
            return { classArena: "" };
    }
}

function getStatusInfo(statusCode) {
    switch (statusCode) {
        case "2":
            return { classStatus: "badge badge-success" };
        case "3":
            return { classStatus: "badge badge-danger" };
        case "4":
            return { classStatus: "badge badge-warning" };
        default:
            return { classStatus: "badge badge-dark" };
    }
}