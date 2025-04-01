function RandomCode(lenght){
    let y = 0;
    let result = '';
    const Character = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    while (y < lenght){
        result += Character.charAt(Math.floor(Math.random() * Character.length))
        y += 1
    }
    return result
}