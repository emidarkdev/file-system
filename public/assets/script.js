let moveFile = (from) => {
    let to = prompt('مسیر خود را وارد کنید','/');
    if (to) {
        location.href =`/move-file?from=${from}&to=${to}`;
    }
}