import router from '@/router/index.js'

function errorHandler(error) { // global deal with errors
    console.log(error.status)

    if (error.status === 400) { // Client Error
        
    } else if (error.status === 422) { // validation errors

    } else if (error.status === 401) { // Unauthorized
        router.push({ name: "login" });
    } else if (error.status === 404) { // not found
        router.push({ name: "404" });
    }  else {
        // global deal with other errors
    }
    // throw error
    Promise.resolve(error)
};

export {errorHandler}