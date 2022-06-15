const express = require('express')
const app = express()
const port = 3000

app.get('/', (req, res) => {
  res.send('Hello World!')
})
app.get('/login/:userid', (req, res) => {
    res.send('Hello World!')
})
app.get('/logout', (req, res) => {
    res.send('Hello World!')
})
app.get('/historial', (req, res) => {
    res.send('Hello World!')
})
app.get('/apostar', (req, res) => {
    res.send('Hello World!')
})

app.listen(port, () => {
  console.log(`Example app listening at http://localhost:${port}`)
})