Pdofy
=====

Contrary to the fact that most mysql_* functions are long depreciated, most PHP developers are adamant to move over
to better world of PDO(PHP Data Objects), owing to their lack of knowledge in SQL injections. Plenty of developers
refrain themselves from even sanitizing user input data, when PHP support plenty of simple inbuilt functions for the
same for quite some time now. When that being the case, a simple level one SQL injection is all that is required to
bring down the entire database.

Another reason may be due to the fact that most PHP developers are not even fluent in OOPs that makes PDO an expensive
endeavor. Though developers can still use the mysql_* functions, they still need to use it in the proper way, which most
developers fail miserably. Given proper care, any developer can still continue using mysql_* functions, but its
recommended to move over to PDO at the very earliest. PDOs may not look as user friendly as their mysql_* conterparts,
but they can efficiently block SQL injections even without sanitizing user input data, and bring in more security to
your applications.

To counter such a situation, the Pdofy class was created. When using the Pdofy class, you shall find it more easier than
using the regular PDO class, and at the same time, bring in more security into your aplications. The class and the example
scripts are highly documented, that even a newbie PHP developer shall be able to create his/her first database driven
application on the fly!

More details can be viewed at https://github.com/robin-thomas/Pdofy. All feedback is appreciated, and in case of any issues
kindly contact me. All developers are invited to contribute to Pdofy!