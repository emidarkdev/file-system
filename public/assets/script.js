let moveFile = (from) => {
    let to = prompt('مسیر خود را وارد کنید','/');
    if (to) {
        location.href =`/move-file?from=${from}&to=${to}`;
    }
}
let changeName = (route) => {
    let name = prompt('نام جدید را وارد کنید');
    if (name) {
        location.href =`/change-name?route=${route}&name=${name}`;
    }
}