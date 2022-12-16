const responseIsOK = (response) => {
  if (!response) return
  return response.status >= 200 && response.status < 300 ? true : false
}

const getFormData = (input) => {
  const formData = new FormData()
  Object.keys(input).forEach((el, index) => {
    if(input[el] === null) {
        formData.append(el, '')
    } else {
        formData.append(el, input[el])
    }
  })

  return formData;
}

export { responseIsOK, getFormData }
