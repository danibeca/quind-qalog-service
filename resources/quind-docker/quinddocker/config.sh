#!/bin/bash

cd /lib/client

# Create the .env file if missing
if [[ ! -f ".env" ]]; then cp /quind.conf .env; fi



