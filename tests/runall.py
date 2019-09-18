#Created by: bms9294
#
# Main testing script, should eventually run all other testing scripts in
# the "tests" directory.

#Stub file, exit 0 for TravisCI setup.
# Created by: bms9294
#
# Designed to run testing classes made for the network.
# The "Try" blocks are used so that all tests are carried out regardless of a
# prior failure.
#
# Classes are used to avoid function naming collisions once a larger number of tests exist.



#Testing Platform
import pytest;

#Funtions to test the Hello World Apache webserver.
import helloworldapache_test;

#Represents the number of failed tests.
FAILED = 0;

#Test the helloworld Website
def testHelloWorld():
    try:
        helloworld = helloworldapache_test.helloWorldTest();
        helloworld.testAll();
    except(AssertionError):
        global FAILED;
        print("Hello World Web Server: Test Failure...");
        # Add one to the Failed test count.
        FAILED = FAILED + 1;



#Handles all the primary function calling.
def main():
    testHelloWorld();
    


#Run the main function to start everything.
main();
print("Exit: "+str(FAILED));
if FAILED == 0:
    print("All tests Successful!");
# If all tests pass then FAILED should still be 0, meaning a clean exit.
exit(FAILED);