using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace Webaruhaz.Models
{
    public class Termek
    {
        public int TermekID { get; set; }
        public int Ar { get; set; }
        public string Nev { get; set; }
        public string Kategoria { get; set; }
    }
}