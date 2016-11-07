using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Data.Entity;
using Webaruhaz.Models;

namespace Webaruhaz.DAL
{
    public class TermekInitializer : System.Data.Entity.DropCreateDatabaseIfModelChanges<TermekContext>
    {
        protected override void Seed(TermekContext context)
        {
            var termekek = new List<Termek>
            {
            new Termek{TermekID=1111,Ar=12,Nev="Alma"},
            new Termek{TermekID=2222, Ar=23,Nev="Korte"},
            new Termek{TermekID=3333,Ar=34,Nev="Banan"},
            new Termek{TermekID=4444,Ar=45,Nev="Citrom"},
            new Termek{TermekID=5555,Ar=56,Nev="Eper"},
            new Termek{TermekID=6666,Ar=67,Nev="Malna"},
            new Termek{TermekID=7777,Ar=78,Nev="Meggy"},
            new Termek{TermekID=8888,Ar=89,Nev="Cseresznye"}
            };

            termekek.ForEach(s => context.Termekek.Add(s));
            context.SaveChanges();
        }
    }
}