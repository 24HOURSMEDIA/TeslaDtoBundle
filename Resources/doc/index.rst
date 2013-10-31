Tesla DTO Bundle
================

Tesla DTO bundle manages (DTO) Data Transfer Objects and its generation.

What are DTO Objects?
---------------------
DTO objects are simple, compound/aggregate object that are used to communicate between remote services.
They are generated from domain objects by an Assembler, and therefore are decoupled from the domain objects themselves.

They solve the problem of reduction of calls (since they may be aggregated among multiple domain objects).

See: http://msdn.microsoft.com/en-us/library/ms978717.aspx

Main actors in this bundle
--------------------------

AbstractAssembler




