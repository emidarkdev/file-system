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
let newDirectory = (route) => {
    let name = prompt('نام پوشه را وارد کنید');
    if (name) {
        location.href =`/create-dir?route=${route}&name=${name}`;
    }
}
let moveSelectAction = () => {
    let newRoute = prompt('مسیر را وارد کنید','/');
    if (newRoute) {
        let move_path = document.getElementById('move_path');
        let select_actions_form = document.getElementById('select_actions');
        move_path.name = 'move_path';
        move_path.value = newRoute;
        select_actions_form.submit();
    }
}