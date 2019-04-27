from chatterbot import ChatBot
from chatterbot.trainers import ChatterBotCorpusTrainer
from chatterbot.response_selection import get_random_response
import os

def get_response(userTxt):
    bot=ChatBot('Alec',
    storage_adapter='chatterbot.storage.SQLStorageAdapter',
    logic_adapters=[
        {
            'import_path':'chatterbot.logic.BestMatch',
            'default_response':'I am sorry, but I do not understand',
            'maximum_similarity_threshold':0.70
        }
    ],
    trainer='chatterbot.trainers.ChatterBotCorpusTrainer')
    trainer= ChatterBotCorpusTrainer(bot)
    while True:
        if userTxt.strip()=='Notice':
            return('Please follow the following link : <br><a href="http://localhost/Notice Board/" target="_blank">Notice Board</a>')
        if userTxt.strip()=='Syllabus of MCA':
            return('Click on the following link : <br><a href="doc/Curriculum_MCAdetailed.pdf" target="_blank">MCA</a>')
        if userTxt.strip()=='Placement statistics':
            return('Placement is quite good. Visit Placement section for further details <br><a href="http://www.mnnit.ac.in/tnp/placement/placementarchive.php" target="_blank">Placement section</a>')
        if userTxt.strip()!='Bye':
            result=bot.get_response(userTxt)
            reply=str(result)
            return(reply)
        if userTxt.strip()=='Bye':
            return('Bye') 
		
			

