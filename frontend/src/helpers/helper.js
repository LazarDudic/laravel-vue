
const responseIsOK = (response) => {
    if(!response) return
    return (response.status >= 200 && response.status < 300) 
        ? true 
        : false;
};

export {
    responseIsOK,
};
