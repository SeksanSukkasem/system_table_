const express = require('express');
const debug = require('debug')('app');
const morgan = require('morgan');


const app = express();
const port = 3000;

app.use(morgan('combined'));

app.get("/",(req,res)=> {
    res.send('Hello');
});

app.listen(port, async ()=> {
    const chalk = await import('chalk');
    debug("Listening on port"+ chalk.default.red(port));
});

