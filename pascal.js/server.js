var fs = require('fs'),
    path = require('path');

function Compiler() {
    var vm = require('vm'),
        Parse = require('./parse'),
        IR = require('./ir.js'),
        llcode = null,
        llvm_path = path.resolve('./llvm.js');

    // Hacks to load the llvm.js compiler directly
    llcode = fs.readFileSync('./llvm.js/compiler.js', "utf8");
    var init_ctx = {
            process: {
                cwd: process.cwd,
                argv: [],
                stdout: {
                    write: function (x) {
                    }
                },
                stderr: {
                    write: function (x) {
                    }
                }
            },
            require: require,
            __dirname: llvm_path
        },
        llcompiler = vm.createContext(init_ctx);

    vm.runInContext(llcode, llcompiler);


    function compileJS(source, cbFail) {
        try {
            var ast = Parse.parser.parse(source);
            var ir = IR.toIR(ast);
            var out = "";
            llcompiler.process.stdout.write = function (x) {
                out += x;
            };
            llcompiler.compile(ir);
            return out;
        } catch (e) {
            cbFail(e.message)
        }

    }

    return {compileJS: compileJS};
}

const express = require('express')
var bodyParser = require('body-parser');
const app = express()
const port = 3000
app.use(function (req, res, next) {
    res.header("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Headers", "X-Requested-With");
    next();
});
app.use(bodyParser.urlencoded({extended: false}));
app.post('/', (req, res) => {
    var compiler = new Compiler();
    let buff = Buffer.from(req.body.code, 'base64');
    let text = buff.toString('utf-8');
    var js = compiler.compileJS(text, function (mess) {
        res.send({success: false, message: mess});
    });
    res.send({success: true, message: new Buffer(js).toString('base64')})
});
app.get('/', (req, res) => {
    res.send("test")
});

app.listen(port, () => console.log(`Example app listening on port ${port}!`));

