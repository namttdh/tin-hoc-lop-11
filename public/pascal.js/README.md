# Pascal.js

## Description

Pascal.js is a Pascal compiler (Turbo Pascal 1.0-ish) implemented in
JavaScript that outputs [LLVM](http://llvm.org) IR (intermediate
representation). The IR can then compiled to native machine code
(using LLVM as a backend), or compiled to JavaScript (via
[LLVM.js](http://github.com/azakai/llvm.js)) so that it can run as
a Node.js script or can run in a browser.

Pascal.js uses an [LALR(1)](http://en.wikipedia.org/wiki/LALR_parser)
(bottom-up lookahead left-to-right) parser generated using
[Jison](http://zaach.github.io/jison/).

Pascal.js is written in JavaScript and outputs JavaScript. This
means you can write, compile and execute Pascal programs entirely in
your browser. Try out the obligatory
[online demo of Pascal.js](http://kanaka.github.com/pascal.js)
(supports at least Chrome and Firefox).


## Why?

Take your pick:

* It has been said: "Great programmers don't program in Pascal but they
have built a compiler for it." Turbo Pascal was my first programming
language (or it could have been Turtle Logo) and now I have built a 
compiler for it. I'm not sure where that leaves me ...

OR

* Pascal and JavaScript exist. Sooner or later somebody was going to
think of putting them together ...

OR

* In the Spring of 2013 I took a compiler class as part of my graduate
studies. The class project was to build a compiler in Java for
a simplified Pascal variant (PCAT). For many years I have been wanting
to ressurect some old Turbo Pascal programs I created in grade school.
There were two obvious paths available to me: get the original 
Turbo Pascal compiler running using [DOSBox](http://www.dosbox.com/),
or create a Turbo Pascal compiler from scratch (inspired by my class
work). I took both paths (of course!). This is the result of that
second path.


## Usage

Make sure that you have the `llvm.js` submodule checked out:

```
git submodule init
git submodule update
```

Download the node jison module and use it to build the lexer/parser
module:

```
make parser.js
```

Compile to JavaScript using `compile.js` and run the resulting
executable directly with node:

```
compile.js tests/ffib.pas build/ffib.js
node build/ffib.js
```

To build native executables, pascal.js uses the `llc` executable that
is part of clang/LLVM. You can install clang on Debian/Ubuntu like this:

```
sudo apt-get install clang
```

Compile to a native executable using `compile_native.js` and run the
resulting executable:

```
compile_native.js tests/ffib.pas build/ffib
build/ffib
```

Generate LLVM IR (skipping assembly) using `ir.js` like this:

```
node ir.js tests/ffib.pas > build/ffib.ll
```


## Language Features Supported

The following features of Turbo Pascal 1.0 are supported:

* Procedures and functions with nested lexical scope
* Scalar Types: Integer, Real, Character, Byte, Boolean, Enumeration,
  Subrange
* Structured Types: String, Array (multidimensional), Record,
  Enumeration
* User defined types
* Automatic and explicit type transfer (coercion): Integer(), Char()
* Forward references (for corecursion)
* Control statements: if/else, for, while, repeat, case
* Standard routines: Concat, Chr, Halt, Odd, Ord, Random, Read,
  ReadLn, Write, WriteLn
* Crt routine (native and Node.js only): ClrScr, Delay, GotoXY,
  KeyPressed, ReadKey


## Missing Language Features / Caveats

The following features of Turbo Pascal 1.0 are not yet supported:

* Pointer type
* Set type
* With statement
* Typed constants
* File types / file routines
* Untyped variable parameters
* Additional standard/crt routines

Some other differences from Turbo Pascal 1.0:

* Crt unit must be explicityly specified
* Default case branch is specified with "otherwise" rather than
  "else" (to address a parsing ambiguity with if/else).
* Strings are current C-style (null terminated). Also, string
  assignment and concatentation leaks memory.


## Intentionally Omitted Language Features

* Labels / Goto
* Compiler directives
* Mem and Port built-in arrays
* Variant Records

