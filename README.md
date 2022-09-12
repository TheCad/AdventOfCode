# Advent of Code

To get this to work be sure to move .env.template to .env and put in your session token.

To find your session token be sure that you are logged in on [AoC](https://adventofcode.com), open the developer tools on the Application tab and on the right select Cookies.

# Usage

**Usage**: aoc &lt;command> [&lt;args>]

**COMMANDS**

run &emsp; Runs the script of the given year and day\
create &emsp; Creates the boilerplate for the given year and day\
test &emsp; Runs the tests of the given year and day

**Example**

`./aoc create 1 2015`\
`./aoc test 1 2015`\
`./aoc run 1 2015`

If no year is given, the current year will be used.